import os
import re

def add_boxicons():
    cdn_link = "<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>\n"
    for file in os.listdir('notuser'):
        if file.endswith('.php'):
            filepath = os.path.join('notuser', file)
            with open(filepath, 'r', encoding='utf-8') as f:
                content = f.read()
            
            if 'boxicons.min.css' not in content:
                # Insert before </head>
                new_content = content.replace('</head>', cdn_link + '</head>')
                
                if new_content != content:
                    with open(filepath, 'w', encoding='utf-8') as f:
                        f.write(new_content)
                    print(f"Added Boxicons to {filepath}")

if __name__ == '__main__':
    add_boxicons()
