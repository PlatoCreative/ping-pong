# Require any additional compass plugins here.
add_import_path "foundation/scss"

http_path = "/"
css_dir = "css"
sass_dir = "scss"
images_dir = "images"
javascripts_dir = "js"

output_style = :compressed
# relative_assets = true
# line_comments = false

if Gem.loaded_specs["sass"].version >= Gem::Version.create('3.4')
  warn "You're using Sass 3.4 or higher to compile Foundation. This version causes CSS classes to output incorrectly, so we recommend using Sass 3.3 or 3.2."
  warn "To use the right version of Sass on this project, run \"bundle\" and then use \"bundle exec compass watch\" to compile Foundation."
end
