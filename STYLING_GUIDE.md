# Panduan Visual & Styling PPID PKTJ

## 🎨 Skema Warna

### Color Palette
- **Primary Blue**: `#004a99` - Header, Main Branding
- **Secondary Yellow**: `#ffc107` - Accents, Highlights
- **Dark Gray**: `#f8f9fa` - Background
- **Text Dark**: `#333333` - Main Text
- **Text Muted**: `#666666` - Secondary Text

### Admin Card Colors
1. **Profil PPID** - Blue (`#004a99`) 
2. **Tugas & Tanggung Jawab** - Amber/Yellow (`#ffc107`)
3. **Visi & Misi** - Green (`#28a745`)
4. **Struktur Organisasi** - Red (`#dc3545`)
5. **Regulasi** - Purple (`#6f42c1`)
6. **Kontak** - Cyan (`#17a2b8`)

---

## 📐 Layout Standards

### Admin Dashboard
```
Header (Admin Panel Title)
├── 6 Cards Grid (2x3 atau 3x2)
│   ├── Card 1: Profil PPID
│   ├── Card 2: Tugas & Tanggung Jawab
│   ├── Card 3: Visi & Misi
│   ├── Card 4: Struktur Organisasi
│   ├── Card 5: Regulasi
│   └── Card 6: Kontak
└── Card Features:
    ├── Icon (Font Awesome)
    ├── Title
    ├── Status (Konten tersedia / Belum ada konten)
    └── Edit Button
```

### Admin Edit Form
```
Header
├── Breadcrumb (Kembali)
├── Title (Edit [Section Name])
└── Form (2 Columns Layout)
    ├── Left Column (8/12)
    │   ├── Judul Halaman
    │   ├── Konten Utama (TinyMCE Editor)
    │   ├── Judul Bagian Tambahan
    │   └── Konten Bagian Tambahan (TinyMCE Editor)
    └── Right Column (4/12)
        ├── Image Upload
        │   ├── Drag-drop area
        │   └── Delete checkbox
        └── Tips Card
            └── Best practices list
```

### Public Page
```
Navigation Bar
├── Logo & Branding
├── Menu Items (Profil, Informasi, Prosedur, LPSE, FAQ, Permohonan)
└── CTA Buttons

Content Area
├── Page Title (32px Bold)
├── Content Box (White bg, shadow)
│   ├── Main Content (dari database)
│   ├── Images (jika ada)
│   ├── Sub-title & Additional Content
│   └── Links/Buttons (jika ada)
└── Footer
```

---

## 🔤 Typography

### Headings
- **H1** (Page Title): 32px, Bold, `#004a99`
- **H2** (Section Title): 24px, Bold, `#004a99`
- **H3** (Sub-section): 18px, Bold, `#004a99`
- **H4-H6**: 14-16px, Semibold, `#333`

### Body Text
- **Regular**: 14px, Normal, `#333`
- **Muted**: 14px, Normal, `#999`
- **Small**: 12px, Normal, `#666`

### Links
- **Default**: `#004a99`, underline on hover
- **Buttons**: White text on color background

---

## 🖱️ Interactive Elements

### Buttons
- **Primary Button** (Submit): `#004a99` bg, white text, rounded corners
- **Secondary Button** (Cancel): `#666` bg, white text
- **Info Button** (Edit): `#0066cc` bg, white text
- **Success Button**: `#28a745` bg, white text
- **Danger Button**: `#dc3545` bg, white text

### Hover States
- Buttons: Darker shade, slight scale-up (transform: translateY(-2px))
- Links: Underline added, color darkens
- Cards: Box shadow increases, background slightly lighter

### Focus States
- Form inputs: Blue border `#004a99`, subtle shadow
- Buttons: Focus ring visible

---

## 📱 Responsive Breakpoints

- **Mobile** (< 576px): Single column, collapsed menus
- **Tablet** (576px - 992px): 2 columns, adjusted spacing
- **Desktop** (> 992px): Full layout, 3 columns in grid

---

## 🎯 Component Guidelines

### Cards (Admin Dashboard)
```css
.card {
    border: none;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    border-top: 4px solid [color];
    border-radius: 8px;
    transition: all 0.3s ease;
}

.card:hover {
    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
    transform: translateY(-5px);
}
```

### Form Groups
```css
.form-control:focus {
    border-color: #004a99;
    box-shadow: 0 0 0 0.2rem rgba(0, 74, 153, 0.25);
}

label {
    font-weight: 600;
    color: #333;
}
```

### Alert/Notice Boxes
```css
.alert-info {
    background-color: #cfe2ff;
    border: 1px solid #0066cc;
    color: #00366b;
}

.alert-warning {
    background-color: #fff3cd;
    border: 1px solid #ffb700;
    color: #664d03;
}
```

---

## 🖼️ Image Guidelines

### Logo
- Format: PNG (transparan)
- Size: 100x100px minimum
- Aspect Ratio: Square atau landscape

### Content Images
- Max Width: 100% of container
- Height: Auto (aspect ratio maintained)
- Border Radius: 8px
- Box Shadow: 0 2px 8px rgba(0,0,0,0.1)

### Icons
- Font Awesome 6.4
- Size: Adjust to context (24px-32px typical)
- Color: Match primary color or contextual color

---

## 🎬 Animation Guidelines

### Transitions
- Duration: 300ms typical
- Easing: ease-in-out
- Properties: color, background, transform, box-shadow

### Hover Effects
- Cards: Lift effect + shadow increase
- Buttons: Color darkening + slight lift
- Links: Color change + underline

---

## 🌐 Public Website Styling

### Header/Navigation
- Background: Linear gradient `#004a99` to `#003366`
- Border Bottom: 3px solid `#ffc107`
- Padding: 12px 0
- Text: White, font-weight bold, uppercase

### Content Sections
- Max Width: 1200px (centered)
- Padding: 50px 20px
- Background: `#f8f9fa`
- Card Background: White
- Border Radius: 8px
- Box Shadow: 0 2px 8px rgba(0,0,0,0.1)

### Section Titles
- Font Size: 28px-32px
- Color: `#004a99`
- Text Transform: Uppercase
- Border Bottom: 3px solid `#ffc107`
- Padding Bottom: 10px
- Display: inline-block

---

## 📋 Form Styling

### Form Containers
- Background: White
- Padding: 30-40px
- Border Radius: 8px
- Box Shadow: 0 2px 8px rgba(0,0,0,0.1)
- Max Width: 800px for single column, full width for multi-column

### Input Fields
- Height: 38px
- Padding: 8px 12px
- Border: 1px solid `#ddd`
- Border Radius: 4px
- Font Size: 14px
- Focus: Border color `#004a99`, shadow `0 0 0 0.2rem rgba(0, 74, 153, 0.25)`

### Text Areas
- Min Height: 150px (adjustable)
- Font: Monospace for code-like content
- Same border/focus as input fields

### Checkboxes & Radio
- Size: 18x18px
- Color: `#004a99`
- Label Margin: 8px from control

---

## ♿ Accessibility Standards

- **Contrast Ratio**: Minimum 4.5:1 for text
- **Focus Indicators**: Visible on all interactive elements
- **Alt Text**: All images should have meaningful alt text
- **ARIA Labels**: Form fields should be properly labeled
- **Keyboard Navigation**: All functions must be keyboard accessible

---

## 🔗 Link Styling

### Document Links
- Color: `#004a99`
- Icon: `<i class="fas fa-file-pdf"></i>` for PDF
- Border Left: 4px solid `#ffc107`
- Padding: 10px 15px
- Hover: Background lighter, transform right

---

## 📞 Contact Card Styling

- Background: Gradient `#004a99` to `#003366`
- Text Color: White
- Padding: 20px
- Border Radius: 8px
- Icon Size: 24px
- Spacing: 10px between items

---

## 🧪 Testing Checklist

- [ ] All colors render correctly on different browsers
- [ ] Responsive design works on mobile/tablet/desktop
- [ ] All animation runs smoothly (60fps)
- [ ] Contrast ratios meet WCAG AA standards
- [ ] Links and buttons are keyboard navigable
- [ ] Form inputs are properly focused
- [ ] Shadow effects are subtle and professional
- [ ] Fonts render clearly on all platforms
