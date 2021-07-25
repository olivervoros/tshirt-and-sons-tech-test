# When you run the migrations use the seeders flag, so your DB will be populated with data for testing
php artisan migrate --seed

# I have added all the endpoints to Postman, and exported out the endpoints to the docs folder.

# Endpoint documentation:
1. Create a contact POST http://localhost:8000/api/contacts

2. Edit a contact PUT http://localhost:8000/api/contacts/{contactId}

3. Retrieve a paginated list of all contacts GET http://localhost:8000/api/contacts

4. Retrieve a single contact GET http://localhost:8000/api/contacts/{contactId}

5. Store multiple contacts for the same company

6. Store notes against a contact POST http://localhost:8000/api/add-notes/{contactId}

7. List all contacts at a given company GET http://localhost:8000/api/list-all-contacts-for-a-company/{companyId}

8. List all companies GET http://localhost:8000/api/companies

9. Search for contacts by contact name GET http://localhost:8000/api/search-for-contact-by-name/{contactName}

10. Search for contacts by company name GET http://localhost:8000/api/search-for-contact-by-company/{companyName}

All the above endpoints are protected by a very simple token based auth, 
so you will need to register a user first, generate a token, and add it to the given request as a bearer token.
Once you have a registered user, you can use the login endpoint to generate a token.
(See images in the docs folder...)

11. Register a User POST http://localhost:8000/api/register

12. Login a user POST http://localhost:8000/api/login
