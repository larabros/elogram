import sys, os
import pypandoc
from sphinx.highlighting import lexers
from pygments.lexers.web import PhpLexer


lexers['php'] = PhpLexer(startinline=True, linenos=1)
lexers['php-annotations'] = PhpLexer(startinline=True, linenos=1)
primary_domain = 'php'

extensions = [
    'sphinxcontrib.phpdomain'
]
templates_path = ['_templates']
source_suffix = '.rst'
master_doc = 'index'
project = u'Elogram'
copyright = u'2016, Hassan Khan'
version = '1'
html_title = "Elogram Documentation"
html_short_title = "Elogram"

exclude_patterns = ['_build']
html_static_path = ['_static']

##### ReadTheDocs theme
import sphinx_rtd_theme
html_theme_path = [sphinx_rtd_theme.get_html_theme_path()]
html_theme = "sphinx_rtd_theme"

# Guzzle theme options (see theme.conf for more information)
html_theme_options = {

    # Set the path to a special layout to include for the homepage
    # "index_template": "homepage.html",

    # Allow a separate homepage from the master_doc
    # homepage = index

    # Set the name of the project to appear in the nav menu
    # "project_nav_name": "Guzzle",

    # Set your Disqus short name to enable comments
    # "disqus_comments_shortname": "my_disqus_comments_short_name",

    # Set you GA account ID to enable tracking
    # "google_analytics_account": "my_ga_account",

    # Path to a touch icon
    # "touch_icon": "",

    # Specify a base_url used to generate sitemap.xml links. If not
    # specified, then no sitemap will be built.
    # "base_url": "http://guzzlephp.org"

    # Allow the "Table of Contents" page to be defined separately from "master_doc"
    # tocpage = Contents

    # Allow the project link to be overriden to a custom URL.
    # projectlink = http://myproject.url
}

path = os.path.join(os.path.dirname(__file__), '..', 'CONTRIBUTING.md')
contrib_md   = open(path, 'r')
devdocs_rst  = open('developers.rst', 'r+')

contributing = pypandoc.convert(contrib_md.read(), 'rst', format='md',
    extra_args=['--reference-links'])
replaced     = devdocs_rst.read().replace('<%CONTRIBUTING%>', contributing)
devdocs_rst.seek(0)
devdocs_rst.write(replaced)
devdocs_rst.close()
