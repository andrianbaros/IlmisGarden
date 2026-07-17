import json
import codecs

found = False
with codecs.open(r'C:\Users\Andrian Baros\.gemini\antigravity\brain\ceccd7f2-2619-4bb6-8bae-7aa5a1212227\.system_generated\logs\transcript_full.jsonl', 'r', encoding='utf-8') as f:
    for line in f:
        if 'Creating robots.txt file' in line or 'robots.txt' in line:
            # Check if it contains the actual content of robots.txt
            if '"toolAction":"Creating robots.txt"' in line or '"toolSummary":"Create robots.txt"' in line or '"TargetFile":"\\"d:/xampp/htdocs/a/robots.txt\\""' in line or 'robots.txt' in line:
                data = json.loads(line)
                if 'tool_calls' in data and len(data['tool_calls']) > 0 and data['tool_calls'][0]['name'] == 'write_to_file':
                    args = data['tool_calls'][0]['args']
                    if 'robots.txt' in args.get('TargetFile', ''):
                        found = True
                        try:
                            content = args['CodeContent']
                            with codecs.open('d:/xampp/htdocs/a/robots.txt', 'w', encoding='utf-8') as out:
                                out.write(content)
                            print("Recovered robots.txt successfully.")
                        except Exception as e:
                            print("Error extracting content:", e)
                        break
if not found:
    print("Could not find the target line in transcript.")
