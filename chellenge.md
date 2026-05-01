# 🛠 The Vehikl Oil Change Challenge
## Objective
Create a small Laravel app that helps determine whether a car is due for an oil change based
on odometer and date inputs.
A car needs an oil change if either of the following is true:
- It’s been more than 5000 km since the last oil change, or
- It’s been more than 6 months since the last oil change.'


### Requirements
1. Setup
○ Use Laravel 12 with a SQLite database for storing data
○ Use Blade templates for the views.
○ Make an initial git commit immediately after setting up Laravel (before starting
your work).
2. Form Page
○ Create a form with the following fields:
■ Current Odometer
■ Date of Previous Oil Change
■ Odometer at Previous Oil Change
○ Validate the input:
■ All fields are required.
■ The current odometer must be greater or equal to the
odometer at previous oil change
■ Date of previous oil change must be valid and in the
past
3. Result Page
○ When the form is submitted:
■ Save the form input to the database.
■ Direct the user to a results page unique to that form submission
■ Display a message indicating whether the car is due for an oil change or
not.
■ Display the original values that were entered in the form.
■ The message and original input should remain visible even if the browser
is refreshed (because it’s stored in the database and the user is on a
result page unique to that submission).
4. Navigation
○ Include a button or link to go back to the original (blank) form to check another
car
○ Do not implement user accounts, authentication, or any index/list of past checks.
○ Do not worry about deleting records.
5. Frontend
○ Use Blade templates for the views.
○ Keep it simple — no JavaScript or frontend frameworks required.
○ A very basic layout and design is fine.
6. Suggested Routes
○ GET / → Show the form
○ POST /check → Handle submission
○ GET /result/{id} → Show the result
