# Job Skill Assessment Test

What we expect from you?
1. Use OOP
2. If you understand S.O.L.I.D. principle, please use it, that's a big plus
3. We prefer quality over quantity, meaning: it's better to submit quality coded un-fished task than finished task with spaghetti code.
4. Use GIT as VCS
5. Your final code does not need to have "fancy" styled output. You can use console or webpage for output. Unit tests would be actually the best choice. Basically, provide us simple as possible way to see your code in action.

# What do we want you to build? (PHP)

You need to code the core structure for a messaging app.

This messaging app has 3 different user types: Student, Teacher and Parent

# Each user type should have:

1. User ID (required)
2. First name (required)
3. Last name (required)
4. Email (required)
5. Profile Photo (optional)


# Difference between user types:

1. Teachers and Parents have Salutation (optional), it's used in the field "full name".
2. Teachers can send messages to any user type
3. Parents and Students can send message only to Teachers


# After initialising the user object we need to have following options:

1. user object needs to have an option to get the full name.
For Students full name is combined from: first name + last name.
For Teachers and Parents is built from: salutation + first name + last name.
2. We need a way to get the profile picture. If there is no profile picture when initialising the user object, we need to get the path/url to a default avatar.
3. Get email
4. Get user id.
5. We need a process to save the user. On save we need to validate email and profile picture. As this is only test, for the profile picture do not make a complex validation, only check if the passed string ends with .jpg, if not save should fail.
Also, this save feature does not need to actually save the user, instead it should only return success if validation passed, and fail if not.


# Each message needs to have (all required):

1. Sender
2. Receiver
3. Message text
4. Creation time (Unix time format)
5. Message type: System or Manual


# For each message we want to have the following features

1. System messages can only be sent from Teachers and only to Students.
2. Process to get full name of sender and receiver
3. Process to get message text
4. Process to get message type
5. Formatted creation time
6. Option to save the message. same as for saving a user, we don't need the actual saving, we just need validation.
For example, if we create new message instance and we set Student as sender, but we also set message type to System, save message should fail as Teacher can only send System messages.

# How final code should look?

We don't want you to implement database or some other data storage provider.

We want code where you/we can create new object instances and pass hard-coded data just for tests. If coded properly, you should be able to easily connect your code with DB.

Your code should be clean and easy for read.

