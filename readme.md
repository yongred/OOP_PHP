# Member List 

### Private Area/Dir
Library of codes public should not have access to.

* All useful functions are in this directory.
* **database_funtions.php**: functions for database connections.
* **db_credentials.php**: Mysql credentials
* **functions.php**: useful functions for html and url.
* **initialize.php**: All functions, classes, and paths var needed are loaded in this file.
* **status_error_functions.php**: Functions for check login, and display session messages.
* **validation_functions.php**: Useful functions for validating inputs.

#### Classes dir
* **databaseobject.class.php**: Class for interacting with database mysql. 
	* Member class inherited from this class.
	* All the main queries are from this class.
	* Use Active Record Design Pattern for interacting with database.
	* Used prepare statement and real_escape_string to prevent sql injection.
	* CRUD operations.
**Database**: indexed by username and email.
* **member.class.php**: Class for member.
	* Represent all properties of 'members' database table.
	* Automatically populate 'members' table attributes to Member class;
	* All attributes of a member
	* Password is hashed.
* **session.class.php**: Class to manage sessions.
	* Login and Logout members.
	* Check if Login
	* Login time limit set to 24 hours.
	* Set and Clear session messages and errors

#### shared dir
* Header and Footer for pages.


### Public Dir
Contains all PHP/HTML pages, JavaScript, and CSS files that the public should have access to.

* **index.php**: Home page, navigates to Sign-up, Report member list, and Login page (if not logged in);

#### member dir
Contains Login, Logout, and sign-up page.

* **sign-up.php**: Sign up member form, display errors or message for successful/unsuccessful sign up.
	* Add new member to database if meet requirements.
	* If password >= 6;
	* If username is unique.
	* Last, First name >= 2 chars;
	* Email address valid format.

#### report
Contains members page and a search server.

* **members.php**: members display page.
	* Only login members can access, if not logged in, redirect to login page.
	* A search form to search email exist. Ajax form submit to search.php, Display either "Exist" or "Not Exist";
	* **JQuery used for Ajax**
	* Table display member informations.




