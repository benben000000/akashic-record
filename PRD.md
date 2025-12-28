# Product Requirements Document (PRD) - Universal Library System

> [!IMPORTANT]
> **Core Philosophy**: A stateless, beautiful window into the world's digital library. We do not host content; we present it beautifully.

## 1. Introduction
The **Universal Library System** is a modern, web-based interface that aggregates open-access knowledge from the Internet Archive and Open Library. It is designed with a premium, focused "iOS-like" aesthetic, running seamlessly on a standard XAMPP stack.

## 2. Requirements & Constraints
- **Platform**: XAMPP (Apache/PHP).
- **Data Source**: Real-time APIs (Internet Archive, Open Library). **Zero local content storage.**
- **Aesthetics**: High-end iOS/Apple design language (Blur, whitespace, typography).
- **Performance**: Instant search, client-side rendering.

## 3. Features

### 3.1. The "Infinity" Search
- **Unified Search Bar**: A large, centered search experience.
- **Filters**: By Type (Text, Audio, Video), Year, Language.
- **Result Grid**: Beautiful card-based layout showing cover art (where available).

### 3.2. Detailed Object View
- **Metadata**: Title, Author, Description, Publisher.
- **Action Buttons**:
    - "Read Online" (Opens IA Viewer).
    - "Download PDF" (Direct link to IA).
    - "Download ePub" (Direct link).

### 3.3. "My Stack" (Client-Side Favorites)
- Uses Browser `localStorage` to save "Favorite" IDs.
- No database required on server (keeps it lightweight as requested).

## 4. Technical Architecture
- **Backend (PHP)**:
    - `api/proxy.php`: A thin wrapper to forward requests to `archive.org`/`openlibrary.org` (avoids CORS issues and simplifies frontend logic).
- **Frontend (HTML/JS/CSS)**:
    - `index.php`: The main entry point.
    - `app.js`: Single file vanilla JS application logic (Router, API calls, UI rendering).
    - `style.css`: Custom CSS variables for iOS glassmorphism + Tailwind CDN for utility speed.

## 5. UI/Design System
- **Font**: Inter (closest free match to San Francisco).
- **Colors**:
    - Background: Off-white / Soft Gray `#F2F2F7` (Light Mode).
    - Cards: White `#FFFFFF` with slight transparency and blur.
    - Accents: iOS Blue `#007AFF`.
- **Interactions**:
    - Hover lift effects.
    - Skeleton loading states.
    - Smooth modal transitions.
