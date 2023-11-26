# Students-Profile

This demonstrates how to use classes in PHP CRUD.

## Model

province -> id (PK, AI), name  
town_city -> id (PK, AI), name  
students -> id (PK, AI), student_number, first_name, last_name, middle_name, gender, birthday  
student_details -> id (PK, AI), student_id (int), contact_number, street, town_city (FK), province (int), zip_code

To Dos:

- CRUD of Province -- Done
- CRUD of Town City -- Done
- Fix Edit of Student's Profile include table student_details -- Done
- Fix Edit of Student's Profile use appropriate controls for gender and birthdate. -- Done
- Modify display in students table include some data from student_details table -- Done
- Fix Gender display use 'F' or 'M' (do not change database structure) -- Done
- Fix Birthdate display use 'Jan 1 2020' format. -- Done
- Fix Delete of Student's Profile include student_details. -- Done

Personal Addition:
- Pagination -- Done


Coding Session 2
- JS stuff