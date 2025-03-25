# Symfony7 Dotien project

## Requirements

- **Docker:** Ensure that Docker is installed on your system before proceeding.

🚀 **Quickly set up Dotien API-a!**


## Getting Started
Follow these steps to build and run the application:

1. Run the `./dkbuild.sh` file to build your container images and run the application.
--------------------------------------------------------------------------------------------
2. Next, run `./dkconnect.sh` to connect to the `app` service container where the *Symfony7* application is running.
3.   **dkconnect** is opening bash shell in the container
--------------------------------------------------------------------------------------------------------------------
4. Run `symfony composer install` to install the application and it's dependencies.
5. Run `symfony console doctrine:database:create` to create database.
6. Run `symfony console doctrine:migrations:migrate` to migrate migrations.



# Next Steps

Congratulations on reaching this stage! This guide will walk you through interacting with the API and managing users and contact lists.

---

## API & Admin Dashboard

- **API URL:** [http://localhost:8880/api](http://localhost:8880/api)
- **DB Admin Dashboard:** [http://localhost:8881](http://localhost:8881)

---

## Creating a User

1. Open the registration endpoint:  
   [http://localhost:8880/api#/User/user_register](http://localhost:8880/api#/User/user_register)
2. Click **Try it out**.
3. Fill out the request body with your user data.
4. Click **Execute**.
5. Hooray—you've created your first user!

---

## Authentication

1. Go to the login endpoint:  
   [http://localhost:8880/api#/Login%20Check/login_check_post](http://localhost:8880/api#/Login%20Check/login_check_post)
2. Click **Try it out**.
3. Enter your existing user credentials in the request body.
4. Click **Execute**.
5. In the response, copy the full Bearer token (e.g., `Bearer eyJ0eXAiO.....`).
6. Click the **Authorize** button at the top of the Swagger UI.
7. Paste the token into the field labeled `Bearer (apiKey)` and click **Authorize**.
8. You are now authenticated and ready to access additional endpoints!

---
> **Note:** You must be authenticated for next endpoints.

## Creating a Contact List


1. Open the contact list creation endpoint:  
   [http://localhost:8880/api#/ContactList/api_contact_lists_post](http://localhost:8880/api#/ContactList/api_contact_lists_post)
2. Click **Try it out**.
3. Fill in the request body with the required details:
    - **Important:** For the `owner` and `users` field, use the format `api/users/{userId}` (e.g., `api/users/1`).
4. Click **Execute**.
5. Your first contact list is created!

---

## Updating a Contact List (PATCH)

1. Navigate to the update endpoint:  
   [http://localhost:8880/api#/ContactList/api_contact_lists_id_patch](http://localhost:8880/api#/ContactList/api_contact_lists_id_patch)
2. Click **Try it out**.
3. Provide the fields you wish to update in the request body.
4. Click **Execute**.
5. The contact list is updated!

---

## Updating a User (PATCH)

1. Go to the user update endpoint:  
   [http://localhost:8880/api#/User/api_me_id_patch](http://localhost:8880/api#/User/api_me_id_patch)
2. Click **Try it out**.
3. Enter the fields you want to update in the request body.
4. Click **Execute**.
5. Your user information has been updated!

---

## Deleting a User

> **Note:** You must be authenticated, and you can only delete your own account.

1. Open the deletion endpoint:  
   [http://localhost:8880/api#/User/api_me_id_delete](http://localhost:8880/api#/User/api_me_id_delete)
2. Provide your user ID in the request (only your account can be deleted).
3. Click **Execute**.
4. Your user account, along with all associated contact lists, will be removed.
