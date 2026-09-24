<h1>Task Management System (Laravel)</h1>

<p>
A professional and robust Task Management System built with Laravel, designed to manage complex user-task relationships with personalized task states and archiving capabilities.
</p>

<h2>Technologies</h2>

<p>
PHP (Laravel Framework), MySQL, Bootstrap 5, Font Awesome, Blade Engine.
</p>

<h2>Core Features</h2>

<h3>User Features</h3>
<p>
- View assigned tasks with personalized status (e.g., in-progress).<br>
- Archive tasks using the <code>is_hidden</code> mechanism to declutter the main list.<br>
- Access a dedicated Archive page to view previously hidden tasks.
</p>

<h3>Admin Features</h3>
<p>
- Full Dashboard with statistics.<br>
- User Management (CRUD with Soft Delete/Restore capabilities).<br>
- Task Assignment & Detachment (managing Many-to-Many relationships).<br>
- Advanced control over user-specific task visibility.
</p>

<h2>Database Architecture</h2>

<p>
The system utilizes a Many-to-Many relationship between <code>users</code> and <code>tasks</code> via a pivot table <code>task_user</code>.
</p>

<code>
// Key Pivot Columns:
- state_of_this_task_user: Stores the unique status for each user-task pair.<br>
- is_hidden: A boolean flag to archive tasks per user without deleting them from the database.
</code>

<h2>Run Project</h2>

<p>
1. Clone the repository into your local environment.<br>
2. Run <code>composer install</code> to install dependencies.<br>
3. Configure your <code>.env</code> file with your database credentials.<br>
4. Run <code>php artisan migrate</code> to set up the database.<br>
5. Run <code>php artisan serve</code> to start the local development server.
</p>

<code>http://localhost:8000/login</code>

<h2>Made By</h2>

<p>MSB</p>
