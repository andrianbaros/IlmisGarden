import os
import re

directory = r'D:\xampp\htdocs\a'
extensions = ('.php', '.html', '.js')

results = []

for root, dirs, files in os.walk(directory):
    if 'notuser' in root.replace('\\', '/').split('/'): # Skip admin if not required, wait, better include to be thorough
        pass
    for file in files:
        if file.endswith(extensions):
            filepath = os.path.join(root, file)
            with open(filepath, 'r', encoding='utf-8', errors='ignore') as f:
                for i, line in enumerate(f):
                    if '.php' in line:
                        # simple heuristic for href, action, header, etc.
                        if re.search(r'(href|action|header|window\.location|location\.href|fetch|ajax)\s*[=(:]\s*[\'"][^\'"]*\.php', line, re.IGNORECASE):
                            rel_path = os.path.relpath(filepath, directory)
                            results.append(f"{rel_path}:{i+1}:{line.strip()}")

with open(r'd:\xampp\htdocs\a\php_refs.txt', 'w', encoding='utf-8') as f:
    for r in results:
        f.write(r + '\n')
