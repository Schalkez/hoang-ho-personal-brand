# Hoang Ho Personal Brand - WordPress Project

## 📁 Cấu trúc dự án

```
hoang-ho-personal-brand/
├── .gitignore                 # Git ignore rules
├── .htaccess                  # Apache rewrite rules
├── docker-compose.yml         # Docker configuration
├── README.md                  # This file
├── wp-content/
│   ├── themes/
│   │   └── filmore/          # Custom WordPress theme
│   │       ├── style.css     # Main stylesheet
│   │       ├── index.php     # Homepage template (Vietnamese)
│   │       ├── page-en.php   # English homepage template
│   │       ├── header.php    # Header template
│   │       ├── footer.php    # Footer template
│   │       ├── functions.php # Theme functions
│   │       └── assets/       # CSS, JS, images
│   └── uploads/              # Media files (ignored by git)
└── filmore.com.vn/           # Static site backup (ignored by git)
```

## 🚀 Cách chạy dự án

### Setup lần đầu (cho người mới):
```bash
# 1. Clone repository
git clone <repository-url>
cd hoang-ho-personal-brand

# 2. Tạo wp-config.php từ template
cp wp-config-sample.php wp-config.php

# 3. Chỉnh sửa wp-config.php với thông tin database:
# DB_NAME = hoang_ho_personal_brand_db
# DB_USER = wordpress  
# DB_PASSWORD = wordpress
# DB_HOST = db:3306

# 4. Khởi động Docker
docker-compose up -d

# 5. Truy cập http://localhost:8080 để setup WordPress
```

### Chạy dự án (đã setup):
```bash
# Khởi động
docker-compose up -d

# Truy cập website
# - Trang chủ (Tiếng Việt): http://localhost:8080
# - Trang English: http://localhost:8080/en/
# - WordPress Admin: http://localhost:8080/wp-admin/
# - phpMyAdmin: http://localhost:8081

# Dừng
docker-compose down
```

## 🎨 Theme Filmore

Theme được phát triển dựa trên thiết kế từ `filmore.com.vn` với các tính năng:

- ✅ **Responsive Design** - Tương thích mobile/desktop
- ✅ **Multi-language** - Hỗ trợ tiếng Việt và tiếng Anh
- ✅ **Hero Slider** - 3 slides với ảnh tối
- ✅ **Modern UI** - Sử dụng Google Fonts (Inter, Playfair Display)
- ✅ **WordPress Integration** - Tích hợp đầy đủ với WordPress

## 📝 Ghi chú quan trọng

### Files được ignore bởi Git:
- `wp-content/uploads/` - Media files (trừ .gitkeep)
- `wp-config.php` - Database configuration (sensitive)
- `*.log` - Log files
- `.env` - Environment files
- `node_modules/` - Node.js dependencies
- `.DS_Store` - macOS system files

### Files được track bởi Git:
- **WordPress Core** - Toàn bộ WordPress core files
- **Custom Theme** - `wp-content/themes/filmore/`
- **Plugins** - `wp-content/plugins/` (nếu có)
- **Configuration** - `.htaccess`, `docker-compose.yml`
- **Documentation** - `README.md`, `.gitignore`

## 🔧 Development

### Thêm ảnh mới:
1. Upload ảnh vào `wp-content/uploads/`
2. Cập nhật đường dẫn trong theme files

### Sửa theme:
1. Chỉnh sửa files trong `wp-content/themes/filmore/`
2. Refresh browser để xem thay đổi

### Database:
- **Host**: localhost:3306
- **Database**: hoang_ho_personal_brand_db
- **User**: wordpress
- **Password**: wordpress

## 📞 Support

Nếu có vấn đề gì, hãy kiểm tra:
1. Docker containers đang chạy: `docker ps`
2. Logs: `docker-compose logs`
3. Database connection trong phpMyAdmin