# HireHero - Find and Rate Your Talent
Freelancer Marketplace Project

## Overview

The Freelancer Marketplace is a web application designed to connect clients with freelancers, making it easier to post jobs and find skilled professionals for various projects. This platform allows clients to find the right freelancers for their needs and helps freelancers discover new job opportunities.

## Features

### User Management

- [x] User registration and authentication (clients and freelancers).
- [x] User profiles with roles (Client or Freelancer).
- [x] User profile details, including contact information and profile picture.

### Job Listings

- [x] Clients can post job listings with project details.
- [x] Job titles, descriptions, budgets, and deadlines.
- [x] Job statuses (Open, In Progress, Completed).

### Bidding System

- [x] Freelancers can submit proposals and bids for jobs.
- [x] Bid amounts and proposals.
- [x] Bid statuses (Pending, Accepted, Rejected).

### Messaging System
The Messaging System implemented using Laravel Chatify that allows users to communicate with each other through private messages. It provides real-time messaging, user privacy, and an intuitive user interface for seamless communication.

- [x] Communication between clients and freelancers.
- [x] Messaging related to specific jobs.
- [x] Real-time messaging functionality.


### Reviews and Ratings

- [ ] Clients and freelancers can leave reviews and ratings for each other.
- [ ] Review ratings and optional review text.

### Payments

- [ ] Secure payment processing for job payments.
- [ ] Escrow services for fund holding.
- [ ] Payment statuses (Pending, Completed).

## Technologies Used

- Laravel PHP Framework
- MySQL Database
- Bootstrap (or other CSS framework for styling)
- JavaScript (for front-end interactivity)
- Laravel Blade Templates

## Setup and Installation

1. Clone the repository to your local machine.
2. Configure your `.env` file with database and other environment settings.
3. Run `composer install` to install project dependencies.
4. Run `php artisan migrate` to create the database tables.
5. Run `php artisan serve` to start the development server.

## Usage

- Register as a client or a freelancer.
- Post job listings, including project details and budgets.
- Browse job listings, submit bids, and communicate with clients.
- Manage your profile, including contact information and profile picture.
- Leave reviews and ratings for completed jobs.
- Make and receive payments for jobs.

## Contributing

Contributions are welcome! If you would like to contribute to this project, please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Make your changes and commit them.
4. Push your changes to your fork.
5. Submit a pull request to the main repository.

## License

This project is licensed under the [MIT License](LICENSE).

## Acknowledgments

- Special thanks to [Laravel](https://laravel.com) for providing a powerful PHP framework.
- Inspired by the concept of freelance marketplaces and online job platforms.
