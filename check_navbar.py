import os

directory = r'D:\xampp\htdocs\a'
frontend_files = ['index.php', 'about.php', 'signin.php', 'signup.php', 'logout.php', 'profile.php', 'bouquet.php', 'plants.php', 'floral.php', 'wedding.php', 'decoration.php', 'workshop.php', 'imlek.php', 'lebaran.php', 'bulan-penuh-cinta.php', 'shop.php', 'product.php', 'product_details.php', 'cart.php', 'transaction.php']

for file in frontend_files:
    filepath = os.path.join(directory, file)
    if os.path.exists(filepath):
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()
            if 'includes/navbar.php' not in content:
                print(f"Missing in {file}")
