import json
import codecs

found = False
with codecs.open(r'C:\Users\Andrian Baros\.gemini\antigravity\brain\ceccd7f2-2619-4bb6-8bae-7aa5a1212227\.system_generated\logs\transcript_full.jsonl', 'r', encoding='utf-8') as f:
    for line in f:
        if 'Rewrite .htaccess to support GZIP compression' in line:
            found = True
            data = json.loads(line)
            try:
                content = data['tool_calls'][0]['args']['CodeContent']
                with codecs.open('d:/xampp/htdocs/a/.htaccess', 'w', encoding='utf-8') as out:
                    out.write(content)
                print("Recovered .htaccess successfully.")
            except Exception as e:
                print("Error extracting content:", e)
            break
if not found:
    print("Could not find the target line in transcript.")
