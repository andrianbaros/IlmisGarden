import os
import re

# We will scan the current directory and specific subdirs
target_dirs = ['.']
exclude_dirs = ['notuser', 'conn', 'css', 'js', 'img', 'fonts']

# The files we are explicitly stripping the .php extension for:
pages_to_strip = [
    'about.php', 'shop.php', 'product_details.php', 
    'profile.php', 'transaction.php', 'logout.php', 'cart.php',
    'product.php', 'artisan.php', 'lebaran.php'
]

def process_file(filepath):
    # skip this script and other temporary files
    if os.path.basename(filepath) in ['strip_php.py', 'check_php.php', 'reapply_all_changes.py']:
        return

    try:
        with open(filepath, 'r', encoding='utf-8') as f:
            content = f.read()
    except Exception:
        return
        
    original_content = content
    
    for page in pages_to_strip:
        base_name = page[:-4]
        
        # Regex to find the page followed by ?, #, or quote
        # (href=|data-link=|action=|"|'|\/)
        pattern = r"(href\s*=\s*['\"]|data-link\s*=\s*['\"]|action\s*=\s*['\"]|\"|'|/)" + re.escape(page) + r"([\?#\"'])"
        
        def replacer(match):
            return match.group(1) + base_name + match.group(2)
            
        content = re.sub(pattern, replacer, content)

    if content != original_content:
        with open(filepath, 'w', encoding='utf-8') as f:
            f.write(content)
        print(f"Updated {filepath}")

def main():
    for root, dirs, files in os.walk('.'):
        # Exclude directories
        dirs[:] = [d for d in dirs if d not in exclude_dirs and not d.startswith('.')]
        
        for file in files:
            if file.endswith('.php') or file.endswith('.html'):
                process_file(os.path.join(root, file))

if __name__ == '__main__':
    main()
