import os
import re

directory = r'D:\xampp\htdocs\a'

seo_data = {
    'index.php': {'title': 'Ilmis Garden | Florist, Bouquet & Decoration Services', 'desc': 'Selamat datang di Ilmis Garden, penyedia layanan karangan bunga, buket, dan dekorasi terbaik.'},
    'about.php': {'title': 'About Us | Ilmis Garden', 'desc': 'Kenali lebih jauh tentang Ilmis Garden, cerita kami, dan passion kami dalam merangkai bunga.'},
    'shop.php': {'title': 'Shop Flowers & Bouquets | Ilmis Garden', 'desc': 'Jelajahi berbagai pilihan bunga dan buket cantik di katalog Ilmis Garden.'},
    'product.php': {'title': 'Our Products | Ilmis Garden', 'desc': 'Temukan berbagai produk unggulan Ilmis Garden.'},
    'product_details.php': {'title': 'Product Details | Ilmis Garden', 'desc': 'Detail produk bunga dari Ilmis Garden.'}, # will be dynamic if possible, but static base is fine
    'profile.php': {'title': 'My Profile | Ilmis Garden', 'desc': 'Kelola profil dan pesanan Anda di Ilmis Garden.'},
    'cart.php': {'title': 'Shopping Cart | Ilmis Garden', 'desc': 'Keranjang belanja Anda di Ilmis Garden.'},
    'transaction.php': {'title': 'Transactions | Ilmis Garden', 'desc': 'Riwayat transaksi Anda di Ilmis Garden.'},
    'bouquet.php': {'title': 'Bouquet Collection | Ilmis Garden', 'desc': 'Koleksi buket bunga cantik untuk setiap momen spesial Anda.'},
    'plants.php': {'title': 'Live Plants | Ilmis Garden', 'desc': 'Koleksi tanaman hias segar untuk mempercantik ruangan Anda.'},
    'floral.php': {'title': 'Floral Arrangements | Ilmis Garden', 'desc': 'Dekorasi dan aransemen bunga premium dari Ilmis Garden.'},
    'wedding.php': {'title': 'Wedding Decorations | Ilmis Garden', 'desc': 'Wujudkan pernikahan impian Anda dengan dekorasi bunga Ilmis Garden.'},
    'decoration.php': {'title': 'Event Decorations | Ilmis Garden', 'desc': 'Layanan dekorasi event dan pesta dengan bunga-bunga terbaik.'},
    'workshop.php': {'title': 'Floral Workshop | Ilmis Garden', 'desc': 'Ikuti kelas merangkai bunga bersama pakar di Ilmis Garden Workshop.'},
    'imlek.php': {'title': 'Chinese New Year Collection | Ilmis Garden', 'desc': 'Koleksi eksklusif bunga Imlek dari Ilmis Garden.'},
    'lebaran.php': {'title': 'Eid Mubarak Collection | Ilmis Garden', 'desc': 'Hampers dan koleksi bunga Lebaran dari Ilmis Garden.'},
    'bulan-penuh-cinta.php': {'title': 'Bulan Penuh Cinta | Ilmis Garden', 'desc': 'Koleksi bunga spesial untuk bulan penuh cinta.'},
    'signin.php': {'title': 'Sign In | Ilmis Garden', 'desc': 'Masuk ke akun Ilmis Garden Anda.'},
    'signup.php': {'title': 'Sign Up | Ilmis Garden', 'desc': 'Daftar akun baru di Ilmis Garden.'},
}

def inject_seo(filepath, filename):
    if filename not in seo_data:
        return
    
    with open(filepath, 'r', encoding='utf-8') as f:
        content = f.read()

    # check if <title> exists
    if '<title>' in content:
        # already has title, maybe just update it and meta?
        # to avoid duplication, let's remove existing title and some common meta tags
        content = re.sub(r'<title>.*?</title>', '', content, flags=re.IGNORECASE|re.DOTALL)
        content = re.sub(r'<meta name="description".*?>', '', content, flags=re.IGNORECASE)
        content = re.sub(r'<link rel="canonical".*?>', '', content, flags=re.IGNORECASE)
        content = re.sub(r'<meta property="og:.*?>', '', content, flags=re.IGNORECASE)
        content = re.sub(r'<meta name="twitter:.*?>', '', content, flags=re.IGNORECASE)
        
    page_name = filename.replace('.php', '')
    if page_name == 'index':
        page_name = ''
    canonical_url = f"https://ilmisgarden.com/{page_name}"
    
    seo_block = f"""
  <title>{seo_data[filename]['title']}</title>
  <meta name="description" content="{seo_data[filename]['desc']}">
  <link rel="canonical" href="{canonical_url}">
  
  <meta property="og:title" content="{seo_data[filename]['title']}">
  <meta property="og:description" content="{seo_data[filename]['desc']}">
  <meta property="og:url" content="{canonical_url}">
  <meta property="og:type" content="website">
  <meta property="og:image" content="https://ilmisgarden.com/img/F4F6F4-full.png">
  
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="{seo_data[filename]['title']}">
  <meta name="twitter:description" content="{seo_data[filename]['desc']}">
  <meta name="twitter:image" content="https://ilmisgarden.com/img/F4F6F4-full.png">
"""

    # insert after <head>
    head_match = re.search(r'<head.*?>', content, re.IGNORECASE)
    if head_match:
        insert_pos = head_match.end()
        new_content = content[:insert_pos] + '\n' + seo_block + content[insert_pos:]
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(new_content)
        print(f"Injected SEO into {filename}")

for root, dirs, files in os.walk(directory):
    if 'notuser' in root.replace('\\', '/').split('/'):
        continue
    for file in files:
        if file.endswith('.php') and file in seo_data:
            filepath = os.path.join(root, file)
            inject_seo(filepath, file)
