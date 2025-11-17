# Villainy Thrives E-Commerce Platform

A custom Laravel-based e-commerce platform for Villainy Thrives apparel brand, featuring manual payment processing, admin order management, and PWA capabilities for mobile access.

## 🎯 Project Overview

**Brand**: Villainy Thrives
**Location**: Huron County, Ontario, Canada
**Established**: 2021
**Tagline**: Choose Loyalty

An apparel brand targeting bikers, fighters, wrestling fans, and blue-collar workers with bold, identity-driven designs.

## 🛠 Tech Stack

- **Framework**: Laravel 12
- **PHP**: 8.2+
- **Database**: SQLite (development) / MySQL/MariaDB (production)
- **Frontend**: Blade Templates + Tailwind CSS + Livewire
- **Authentication**: Laravel Jetstream with Livewire
- **Admin Panel**: Filament v3.3
- **Shopping Cart**: hardevine/shoppingcart
- **Payment Processing**: Manual (Cash/E-Transfer) + Laravel Cashier (Stripe - Optional)
- **Asset Building**: Vite
- **Testing**: Pest PHP

## 📦 Features

### ✅ Completed

- [x] **Authentication System**
  - Laravel Jetstream with Livewire
  - User registration and login
  - Profile management
  - Two-factor authentication support

- [x] **Database Schema**
  - Categories (name, slug, description, active status)
  - Products (with Printful integration fields)
  - Orders (supports multiple payment methods)
  - Order Items (with fulfillment tracking)
  - Full Eloquent relationships

- [x] **Admin Panel (Filament)**
  - Accessible at `/admin`
  - Auto-generated CRUD for Categories
  - Auto-generated CRUD for Products
  - Auto-generated CRUD for Orders
  - Full order management capabilities

- [x] **E-Commerce Backend**
  - Shop Controller (product listing, filtering, search)
  - Cart Controller (add, update, remove items)
  - Checkout Controller (order creation)
  - Manual payment support (Cash & E-Transfer)

- [x] **Shopping Cart**
  - Session-based cart management
  - Add/Update/Remove items
  - Quantity management
  - Cart totals calculation

### 🚧 Pending (MVP)

- [ ] **Frontend Views**
  - Homepage with hero section
  - Shop page with category filters
  - Product detail pages
  - Shopping cart page
  - Checkout page
  - Order confirmation page

- [ ] **Accounting/Ledger System**
  - Sales tracking
  - Revenue reporting
  - Expense management
  - Basic bookkeeping for manual record-keeping

- [ ] **PWA Functionality**
  - Service worker setup
  - Offline capability
  - Install prompt for mobile devices
  - Mobile-optimized admin access

- [ ] **Email Notifications**
  - Order confirmation emails
  - Payment received notifications
  - Order status updates

- [ ] **SEO & Meta Tags**
  - Dynamic meta descriptions
  - Open Graph tags
  - Sitemap generation

### 📋 Optional/Future Features

- [ ] Stripe payment integration
- [ ] Printful API integration for drop-shipping
- [ ] Advanced analytics
- [ ] Customer accounts and order history
- [ ] Product reviews
- [ ] Discount codes/promotions

## 🚀 Installation

### Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & NPM
- SQLite (dev) or MySQL/MariaDB (production)

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd Villainy-Thrives
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install NPM dependencies**
   ```bash
   npm install
   ```

4. **Environment Configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configure Database**

   For SQLite (Development):
   ```bash
   touch database/database.sqlite
   ```

   For MySQL (Production):
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=villainy_thrives
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

6. **Run Migrations**
   ```bash
   php artisan migrate
   ```

7. **Link Storage**
   ```bash
   php artisan storage:link
   ```

8. **Build Assets**
   ```bash
   npm run build
   ```

9. **Create Admin User**
   ```bash
   php artisan make:filament-user
   ```
   Follow prompts to create your admin account.

10. **Start Development Server**
    ```bash
    php artisan serve
    ```
    Access at: `http://localhost:8000`

## 📁 Project Structure

```
villainy-thrives/
├── app/
│   ├── Filament/Resources/      # Admin panel resources
│   ├── Http/Controllers/        # Shop, Cart, Checkout controllers
│   ├── Models/                  # Category, Product, Order, OrderItem
│   └── Providers/
├── config/
│   └── cart.php                 # Shopping cart configuration
├── database/
│   ├── migrations/              # Database schema
│   └── seeders/
├── public/
│   └── storage/images/          # Logo and product images
├── resources/
│   ├── views/
│   │   ├── shop/               # Shop views (pending)
│   │   ├── cart/               # Cart views (pending)
│   │   └── checkout/           # Checkout views (pending)
│   └── js/
├── routes/
│   └── web.php                 # Application routes
└── storage/
    └── app/public/images/      # Uploaded images
```

## 🎨 Branding Assets

**Logo Location**: `storage/app/public/images/villainy-thrives-logo.jpeg`
**Public URL**: `/storage/images/villainy-thrives-logo.jpeg`

**Logo Design**:
- Circular badge with crossed sledgehammers
- "VILLAINY THRIVES" (top arc)
- "CHOOSE LOYALTY" (bottom arc)
- "EST. 2021" (center)
- Black and white color scheme

## 🛒 Usage

### Admin Panel

1. Access admin at `/admin`
2. Login with your admin credentials
3. Manage:
   - **Categories**: Create product categories (T-Shirts, Hoodies, Hats, etc.)
   - **Products**: Add products with pricing, images, descriptions
   - **Orders**: View and manage customer orders

### Creating Products

1. Navigate to Admin → Products
2. Click "New Product"
3. Fill in:
   - Name
   - Slug (auto-generated)
   - Category
   - Description
   - Price (CAD)
   - Image URL or upload
   - Active status
4. Save

### Managing Orders

Orders are created through the checkout process with payment methods:
- **Cash**: In-person payment
- **E-Transfer**: Email money transfer

Order statuses:
- `pending`: Awaiting payment
- `paid`: Payment received
- `processing`: Being prepared
- `shipped`: Out for delivery
- `completed`: Delivered
- `cancelled`: Cancelled

## 🔐 Configuration

### Required Environment Variables

```env
APP_NAME="Villainy Thrives"
APP_ENV=local
APP_URL=http://villainythrives.test

DB_CONNECTION=sqlite

SESSION_DRIVER=database
QUEUE_CONNECTION=database
```

### Optional (Future Use)

```env
# Stripe (Optional)
STRIPE_KEY=your_stripe_key
STRIPE_SECRET=your_stripe_secret

# Printful (Optional)
PRINTFUL_API_KEY=your_printful_key

# Mail
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
```

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test suite
php artisan test --testsuite=Feature
```

## 📱 PWA Setup (Pending)

The PWA functionality will enable:
- Mobile app-like experience
- Offline access to admin panel
- Push notifications for new orders
- Home screen installation

## 💰 Payment Methods

### Manual Payments (Current)

**Cash**:
- In-person sales at markets/events
- Mark as paid manually in admin

**E-Transfer**:
- Email instructions sent after order
- Mark as paid manually after receiving transfer

### Stripe (Optional/Future)

- Credit card processing
- Automatic payment confirmation
- Webhook integration

## 🚢 Deployment

### Production Checklist

- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Configure MySQL database
- [ ] Set up proper mail driver
- [ ] Configure queue worker
- [ ] Set up SSL certificate
- [ ] Configure backup strategy
- [ ] Set up monitoring/logging
- [ ] Optimize assets: `npm run build`
- [ ] Cache config: `php artisan config:cache`
- [ ] Cache routes: `php artisan route:cache`

## 📊 Database Schema

### Categories
- `id`, `name`, `slug`, `description`, `active`, `timestamps`

### Products
- `id`, `category_id`, `name`, `slug`, `description`, `price`
- `image_url`, `printful_product_id`, `printful_variant_id`
- `active`, `timestamps`

### Orders
- `id`, `user_id`, `order_number`, `total`, `status`
- `payment_method`, `stripe_payment_id`
- `customer_name`, `customer_email`, `customer_phone`
- `shipping_address` (JSON), `billing_address` (JSON)
- `notes`, `timestamps`

### Order Items
- `id`, `order_id`, `product_id`, `quantity`, `price`
- `printful_order_id`, `timestamps`

## 🤝 Contributing

This is a private project for Villainy Thrives. For questions or suggestions:
- Contact: Craiger (Brand Owner)
- Developer: Marcel Gagnon

## 📝 License

Proprietary - All rights reserved by Villainy Thrives (Est. 2021)

## 🔗 Links

- **Website**: https://villainythrives.com
- **Admin Panel**: `/admin`
- **Social Media**: [Links to be added]

## 📞 Support

For technical support or questions about the platform:
- Create an issue in this repository
- Contact the development team

---

**Built with ❤️ for the Villainy Thrives community**
*Choose Loyalty* 🔨🔨
