# Pizza day

## Project Overview

This project is part of the Web Technologies course at Conestoga College. The goal of this assignment is to develop a web application that demonstrates the use of various web technologies and best practices.

## Features

- Responsive design
- Interactive UI components
- Use of design patterns

## Technologies Used

- HTML5
- CSS3
- JavaScript (ES6+)
- PHP
- MySQL

## Installation

1. Clone the repository:
    ```bash
    git clone git@github.com:rodrigobruner/pizzaria.git
    ```
2. Navigate to the project directory:
    ```bash
    cd pizzaria
    ```
3. Create a vhost on your web server pointing to the /public directory


4. Configuring the database

    4.1 Create a database on your MySQL server;
    
    4.2 Select your database and run the /docs/database.sql file to create the tables;

    4.3 Rename the file 
    
    > src/lib/connection-sample.php 

    to 

    >src/lib/connection.php 
    
    and set the following parameters:

     ```bash   
    // Database settings
    private static $host = '[SERVER]';
    private static $database = '[DATABASE]';
    private static $username = '[USERNAME]';
    private static $password = '[PASSWORD]';
      ```

## Usage

1. Open your browser and navigate to `http://[HOSTNAME]:[PORT OF YOUR WEB SERVER]`.

## Contributing

Contributions are welcome! Please fork the repository and create a pull request with your changes.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact

For any questions or feedback, please contact Rodrigo Bruner at me@bruner.app
