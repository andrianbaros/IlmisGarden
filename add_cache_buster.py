import os
import re

def update_css_cache_buster():
    for file in os.listdir('notuser'):
        if file.endswith('.php'):
            filepath = os.path.join('notuser', file)
            with open(filepath, 'r', encoding='utf-8') as f:
                content = f.read()
            
            # replace href="admin_theme.css" with href="admin_theme.css?v=<?= time() ?>"
            # this ensures it always busts cache during testing
            new_content = re.sub(r'href="admin_theme\.css"', r'href="admin_theme.css?v=<?= time() ?>"', content)
            
            if new_content != content:
                with open(filepath, 'w', encoding='utf-8') as f:
                    f.write(new_content)
                print(f"Updated {filepath}")

if __name__ == '__main__':
    update_css_cache_buster()
