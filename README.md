# FYPWise Web Application

## Overview
FYPWise is a web-based application designed to manage and streamline the workflow of Final Year Project (FYP) management. 
The system follows an MVC-inspired architecture and employs a router-based navigation system for better organization and maintainability. 
The application provides various features to assist students, lecturers, and administrators in handling project-related tasks efficiently.

## Features
- **User Role Management**: Supports multiple roles, such as students, lecturers which are supervisors or moderators, and administrators.
- **Proposal Submission**: Allows supervisors to submit project proposals with relevant details.
- **Project Assignment**: Facilitates the assignment of projects to students.
- **Project Progress Tracking**: Enables supervisors to monitor students' project progress.
- **File Upload & Management**: Allows users to upload documents related to their projects.
- **Search and Filtering**: Users can search and filter projects based on specific criteria.
- **Authentication & Security**: Implements password validation and access control for secure usage.`

## How to Navigate the Application
1. **Homepage**: Users start at the homepage, where they can log in based on their assigned roles.
2. **Dashboard**: After logging in, users are redirected to their respective dashboards:
   - **Student**: Can submit project submissions and update project timelines.
   - **Supervisors**: Can submit project proposals, assign advisees to project and monitor project progress.
   - **Moderators**: Can fill in marksheet page based on criteria
   - **Administrators**: Can manage users, create presentation slots for projects, assign moderators to projects, and oversee system activity.
3. **Project Management**:
   - Students upload documents, update project details, and track deadlines.
   - Supervisors provide feedback and track project milestones.
4. **Navigation Menu**: The side menu provides quick access to key sections like "My Projects," "Submissions," and "Supervisor Assignments."
5. **Search & Filtering**: Users can search for projects, filter based on category, and view detailed project information.

## Setup Instructions
1. Install dependencies using Composer
   ```
   php composer.phar install
   ```
2. Set up the database
4. Run the application in XAMPP starting with http://localhost/FYPWise-web/

## Additional Notes
- Ensure all dependencies are installed via Composer before running the application.
- The database should be correctly set up with `table_creation.sql` and `sample_data.sql` before using the system.
