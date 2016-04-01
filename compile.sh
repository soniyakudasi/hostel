lessc less/main.less > public/css/main.css
jade jade/*.jade --preety -o ./public/ -E php --pretty
jade jade/admin/*.jade --preety -o ./public/admin/ -E php --pretty
