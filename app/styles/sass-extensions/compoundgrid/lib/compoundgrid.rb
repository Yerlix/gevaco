require "rubygems"
require "base64"

Compass::Frameworks.register("compoundgrid",
  :stylesheets_directory  => File.join(File.dirname(__FILE__), "stylesheets")
)