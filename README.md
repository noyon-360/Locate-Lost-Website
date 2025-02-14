<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Locate Lost

Locate Lost is a web application designed to help find missing persons. The application allows multiple stations to add missing reports, users to view these reports, submit comments, and provide seen locations. The stations can then work on the information submitted by users to locate the missing persons.

## Features

- **Admin Dashboard**: Manage users and stations, view pending accounts, and approve or reject registrations.
  ![Admin Dashboard](screenshots/admin_dashboard.png)
- **Station Dashboard**: Add missing person reports, view and manage reports, and respond to user submissions.
  ![Station Dashboard](screenshots/station_dashboard.png)
- **User Dashboard**: View missing person reports, submit comments, and provide seen locations with map pinning functionality.
  ![User Dashboard](screenshots/user_dashboard.png)
- **Interactive Map**: Users can pin locations on the map where they have seen the missing person.
  ![Interactive Map](screenshots/interactive_map.png)
- **Notifications**: Stations and admins receive notifications for new submissions and updates.

## Installation

1. Clone the repository:
    ```sh
    git clone https://github.com/yourusername/locate-lost.git
    cd locate-lost
    ```

2. Install dependencies:
    ```sh
    composer install
    npm install
    ```

3. Copy the [`.env.example`](.env.example ) file to [`.env`](.env ) and configure your environment variables:
    ```sh
    cp .env.example .env
    ```

4. Generate an application key:
    ```sh
    php artisan keygenerate
    ```

5. Run the database migrations:
    ```sh
    php artisan migrate
    ```

6. Seed the database (optional):
    ```sh
    php artisan db:seed
    ```

7. Start the development server:
    ```sh
    php artisan serve
    npm run dev
    ```

## Usage

### Admin

- **Dashboard**: View admin details, manage users and stations, and view pending accounts.
  ![Admin Dashboard](https://github.com/user-attachments/assets/d23805d2-d9f7-4936-91d7-be80082ec9f9)
- **Pending Accounts**: Approve or reject user and station registrations.
  ![Pending Accounts](screenshots/pending_accounts.png)
  ![Pending Accounts](![Image](https://github.com/user-attachments/assets/2c101bdf-cc01-4233-a3a9-09051f4e9dee)
![Image](https://github.com/user-attachments/assets/bf63e2bc-6671-4630-93c6-301d2727ccb8)
![Image](https://github.com/user-attachments/assets/8cf99223-fa67-416c-a131-b1e7e268cd7d)
![Image](https://github.com/user-attachments/assets/d23805d2-d9f7-4936-91d7-be80082ec9f9)
![Image](https://github.com/user-attachments/assets/4ce61955-e7d4-41cd-83cb-63a0529ddb30))
### Station

- **Dashboard**: Add and manage missing person reports, view user submissions, and respond to them.
  ![Station Dashboard](screenshots/station_dashboard_usage.png)
- **Add Missing Person**: Fill out the form with personal information, missing info, family info, contact info, and upload images.
  ![Add Missing Person](screenshots/add_missing_person.png)

### User

- **Dashboard**: View personal details, missing reports, and submit comments and seen locations.
  ![User Dashboard](screenshots/user_dashboard_usage.png)
- **View Missing Reports**: Search and filter missing person reports, view details, and submit information.
  ![View Missing Reports](screenshots/view_missing_reports.png)

### Map Functionality

- **Add Info**: Users can pin locations on the map where they have seen the missing person.
  ![Add Info](screenshots/add_info.png)
- **View Location**: View the pinned location on the map with details of the submission.
  ![View Location](screenshots/view_location.png)

## Contributing

Contributions are welcome! Please follow these steps to contribute:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/your-feature-name`).
3. Commit your changes (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature/your-feature-name`).
5. Open a pull request.

## License

This project is licensed under the MIT License. See the LICENSE file for details.

## Acknowledgements

- [Laravel](https://laravel.com) - The PHP framework used.
- [Leaflet](https://leafletjs.com) - The JavaScript library for interactive maps.
- [Tailwind CSS](https://tailwindcss.com) - The CSS framework used for styling.

## Contact

For any inquiries or support, please contact [your-email@example.com](mailto:your-email@example.com).
