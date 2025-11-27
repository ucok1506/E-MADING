# Screenshot Guide - Manual Capture

## Required Screenshots for User Guide

### 1. Start Your Application
```bash
cd c:\xampp\htdocs\mading
php artisan serve
```

### 2. Screenshots Needed

#### A. **home-page.png**
- URL: `http://localhost:8000`
- What to capture: Full homepage showing article grid, navigation, search filters
- Key elements: Logo, navigation bar, search box, category filters, article cards

#### B. **login-page.png** 
- URL: `http://localhost:8000/login`
- What to capture: Login form with glassmorphism design
- Key elements: Logo, login form, demo account info, background gradient

#### C. **dashboard.png**
- URL: `http://localhost:8000/dashboard` (login first with admin@smk.sch.id / admin123)
- What to capture: Dashboard with statistics cards and article management
- Key elements: Statistics cards, article table, navigation with notifications

#### D. **create-article.png**
- URL: `http://localhost:8000/mading/create` (after login)
- What to capture: Article creation form
- Key elements: Two-column layout, form fields, category dropdown, image upload

#### E. **manage-articles.png**
- URL: `http://localhost:8000/mading` (after login)
- What to capture: Article management table
- Key elements: Article list table, action buttons, status badges

#### F. **search-feature.png**
- URL: `http://localhost:8000` (show search in action)
- What to capture: Search interface with filters active
- Key elements: Search box filled, category filter selected, sorting dropdown

#### G. **like-system.png**
- URL: `http://localhost:8000` (focus on article cards)
- What to capture: Article cards showing like buttons and counters
- Key elements: Heart icons, like counters, article cards

#### H. **notifications.png**
- URL: `http://localhost:8000/dashboard` (click notification bell)
- What to capture: Notification dropdown opened
- Key elements: Notification bell with badge, dropdown menu with notifications

## Manual Screenshot Methods

### Method 1: Browser Developer Tools (Best Quality)
1. Press F12 → Console
2. Type: `document.body.style.zoom = "0.8"` (optional, for better fit)
3. Press Ctrl+Shift+P
4. Type "screenshot" → Select "Capture full size screenshot"

### Method 2: Windows Snipping Tool
1. Press Windows + Shift + S
2. Select "Rectangular Snip"
3. Drag to select area
4. Save to screenshots folder

### Method 3: Print Screen
1. Press Alt + Print Screen (current window)
2. Open Paint
3. Ctrl + V to paste
4. Save as PNG

## File Naming
Save files exactly as:
- home-page.png
- login-page.png  
- dashboard.png
- create-article.png
- manage-articles.png
- search-feature.png
- like-system.png
- notifications.png

## Demo Login Credentials
- Admin: admin@smk.sch.id / admin123
- Guru: guru@smk.sch.id / guru123
- Siswa: siswa@smk.sch.id / siswa123