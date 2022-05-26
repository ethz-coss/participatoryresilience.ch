from jinja2 import Environment, FileSystemLoader
import os, sys, pathlib
import yaml

try:
    src_dir = sys.argv[1]
    out_dir = sys.argv[2]
    config_yaml = pathlib.Path(sys.argv[3])
except IndexError:
    sys.exit("Please call with python main.py <temmplate_dir> <output_dir> <content>.yaml")


env = Environment( loader = FileSystemLoader(src_dir) )
template = env.get_template('main.html')

page_context = yaml.safe_load(config_yaml.read_text())
# print(page_context)

filename = os.path.join(out_dir, 'index.html')
with open(filename, 'w') as f:
    f.write(template.render(**page_context))
