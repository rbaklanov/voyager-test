## Routing

All the routes SHOULD be defined in `web.php` file that provided by Laravel out of the box. It is responsible for mapping all the incoming HTTP requests to corresponding controller's functions. 

`web.php` SHOULD contain Endpoints - URL patterns that identify the incoming request.

When an HTTP request hits the Application, the Endpoints match with the URL pattern and make the call to the corresponding Controller function.



## Controllers

Controllers are responsible for validating the request, processing the request data and building a response. *Validation and response, performs in separate classes, but triggered from the Controller*.

The Controllers concept is the same as in MVC *(They are the C in MVC)*, but with limited and predefined responsibilities.

#### Principles:
- Controllers SHOULD NOT know anything about the business logic or about any business object.

- A Controller SHOULD only do the following things:
   1. Reading a Request data (user input)
   2. Calling an Action (and passing request data to it)
   3. Building a Response (usually build response based on the data collected from the Action call)
   
- Controllers SHOULD NOT have any form of business logic. (It SHOULD call an Action to perform the business logic).

- Controllers SHOULD NOT call any Domains tasks. They MAY only call Actions. (And then Actions can call Domains Tasks).

- Controllers CAN be called by corresponding endpoints only.




## Requests

Requests mainly process the user input in the application. And they are very useful to automatically apply the Validation and Authorization rules.

Requests are the best place to apply validations, since the validations rules will be related to every request.
Requests can also check the Authorization, e.g. check if this user has access to this controller function.

#### Principles:
- A Request MAY hold the Validation / Authorization rules.
- Requests SHOULD only be injected in Controllers. Once injected they automatically check if the request data matches the validation rules, and if the request input is not valid an Exception will be thrown.
- Requests MAY also be used for authorization, they can check if the user is authorized to make a request.



## Actions

Actions represent the Use Cases of the Application.

Actions CAN hold business logic or/and they call the Tasks to perform the business logic.

Actions take data structures as inputs, manipulates them according to the business rules internally or through some Tasks, then output a new data structures.

Actions SHOULD NOT care how the Data is gathered, or how it will be represented.

#### Principles:
- Every Action SHOULD be responsible for doing a single Use Case in the Application.
- An Action MAY retrieves data from Tasks and pass data to another Task.
- An Action MAY call multiple Tasks. They can even call Tasks from other Domains as well.
- Actions MAY return data to the Controller.
- Actions SHOULD NOT return a response. That's the job of the Controller.
- An Action SHOULD NOT call another Action.
- Actions are mainly used from Controllers. However, they can be used from Events Listeners, Commands and/or other Classes. But they SHOULD NOT be used from Tasks.
- Every Action SHOULD have only a single function named `execute()`.
- The Action main function `execute()` can accept a Request Object in the parameter.



## Tasks

The Tasks are the classes that hold the shared business logic between multiple Actions across different Domains.

Every Task is responsible for a small part of the logic.

Example: if we have Action 1 that needs to find a record by its ID from the DB, then fires an Event.
And we have an Action 2 that needs to find the same record by its ID, then makes a call to an external API.
Since both actions are performing the "find a record by ID" logic, we can take that business logic and put it in it's own class, that class is the Task. This Task is now reusable by both Actions and any other Action you might create in the future.

The rule is, whenever we see the possibility of reusing a piece of code from an Action, we should put that piece of code in a Task. We do not need to create Tasks for everything, we can always start with writing all the business logic in an Action and only when we need to reuse it, create an a dedicated Task for it. 

#### Principles:
- Every Task SHOULD have a single responsibility (job).
- A Task MAY receive and return Data. 
- A Task SHOULD NOT call another Task. 
- A Task SHOULD NOT call an Action. 
- Tasks SHOULD only be called from Actions. They could be called from Actions of other Domains as well!.
- Tasks usually have a single function `execute()`. 
- A Task SHOULD NOT be called from Controller. Because this leads to non-documented features in our code. It's totally fine to have a lot of Actions e.g.  `FindUserByIdAction` and `FindUserByEmailAction` where both Actions are calling the same Task as well as it's totally fine to have single Action `FindUserAction` making a decision to which Task it should call.
- A Task SHOULD NOT accept a Request object in any of its functions. It can take anything in its functions parameters but never a Request object. This will keep free to use from anywhere, and can be tested independently.



## Models

The Models provide an abstraction for the data, they represent the data in the database. *(They are the M in MVC)*.

Models are responsible for how the data should be handled. They make sure that data arrives properly into the backend store (e.g. Database).

#### Principles:
- A Model SHOULD NOT hold business logic, it can only hold the code and data the represents itself. *(it's relationships with other models, hidden fields, table name, fillable attributes,...)*
- A single Domain MAY contains multiple Models.
- A Model MAY define the Relations between itself and any other Models (in case a relation exist).



## Repositories

The Repository classes are an implementation of the Repository Design Pattern.
Their major roles are separating the business logic from the data (or the data access Task).
Repositories saves and retrieves Models to/from the underlying storage mechanism.
The Repository is used to separate the logic that retrieves the data and maps it to a Model, from the business logic that acts on the Model.

#### Principles:
- Every Model SHOULD have a Repository.
- A Model SHOULD always get accessed through its Repository. (Never direct access to Model).



## Data Transfer Objects

DTO are used to pass user data that coming from Requests, Commands, or other places from one place to another (Actions to Tasks / Controller to Action / Command to Action / and so on).

They are very useful for reducing the number of parameters in functions, which prevents the duplication of the long parameters.



## Request Life Cycle

*A typical very basic API call scenario:*

1. **Client** calls an `Endpoint` in a `web.php` file.
2. `Endpoint` calls a `Middleware` to handle the Authentication.
3. `Endpoint` calls its `Controller` function.
4. `Request` injected in the `Controller` automatically applies the request validation & authorization rules.
5. `Controller` calls an `Action` and pass each `Request` data to it.
6. `Action` do the business logic, *OR can call as many `Tasks` as needed to do the reusable subsets of the business logic*.
7. `Tasks` do a reusable subsets of the business logic (A `Task` can do a single portion of the main Action).
8. `Action` prepares data to be returned to the `Controller`, *some data can be collected from the `Tasks`*.
9. `Controller` builds the response and send it back to the **Client**.
