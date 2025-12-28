# System Architecture

## Overview
The Universal Library System follows a **Three-Tier Proxy Architecture** optimized for XAMPP.

```mermaid
graph TD
    User[User Browser] <-->|HTTP/JSON| FE[Frontend (Vanilla JS + Tailwind)]
    FE <-->|Internal API| PHP[PHP Proxy (api/proxy.php)]
    PHP <-->|External API| IA[Internet Archive API]
    PHP <-->|External API| OL[Open Library API]
    
    subgraph Client [Client Side]
        FE
        LS[LocalStorage (Favorites)]
        FE --> LS
    end
    
    subgraph Server [XAMPP Server]
        PHP
    end
```

## Components

### 1. Frontend Layer
- **Technology**: HTML5, Vanilla JavaScript (ES6+), CSS3 (Variables + Tailwind CDN).
- **Responsibility**: State management, UI rendering, User Input.
- **Key Modules**:
    - `App`: Main controller.
    - `DOM`: View logic.
    - `ProxyService`: Fetches data from PHP.

### 2. Application Layer (Backend)
- **Technology**: PHP 8.x.
- **Responsibility**: 
    - Request validation.
    - Setting strict User-Agents for external APIs.
    - CORS and Header management.
    - Hiding API nuances from Frontend.

### 3. Data Layer (External)
- **Internet Archive**: Search API (Advanced Search JSON).
- **Open Library**: Books API (Works, Editions, Covers).

## Data Flow
1.  User enters search term.
2.  JS sends request to `proxy.php?action=search&q=...`.
3.  PHP constructs full URL for Archive.org.
4.  Archive.org responds with JSON.
5.  PHP forwards JSON to JS.
6.  JS renders "Cards" with Glassmorphism styles.
