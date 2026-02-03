# Assignment -02 [Authentication & Profile Management]

### Name : Sagar

### Email: sagar.cmt1920@gmail.com

## Project Summary

This is a PHP-based Authentication and Profile Management system with the following features:

### Features
- **User Authentication**: Login and signup functionality with secure password hashing
- **Registration Success Message**: User-friendly success notification after signup
- **Profile Management**: Edit user name and email address
- **Password Security**: Change password with current password verification
- **Session Management**: Secure session handling and logout functionality
- **Logout System**: Complete session termination with cookie cleanup
- **Form Validation**: Input validation and error handling with user-friendly messages
- **Responsive UI**: Modern, clean interface built with Tailwind CSS

### File Structure
- `login.php` - User login page
- `signup.php` - User registration page
- `dashboard.php` - User dashboard/homepage
- `edit-profile.php` - Edit profile form
- `edit_profile_post.php` - Profile update handler
- `change-password.php` - Change password form
- `change_password_post.php` - Password update handler
- `logout_post.php` - Logout handler
- `layout.php` - Header and navigation layout
- `config/db.php` - Database configuration

### Technologies Used
- PHP (Backend)
- MySQL (Database)

## Logout System

The logout system ensures secure termination of user sessions:

### How It Works
1. **Session Cleanup**: Clears all session variables
2. **Session Destruction**: Destroys the session
3. **Cookie Removal**: Removes session cookies from the browser
4. **Redirect**: Redirects user to login page

### Features
- Complete session data removal
- Secure cookie deletion
- Automatic redirect to login
- Prevents session hijacking
- Works across all pages via navigation button