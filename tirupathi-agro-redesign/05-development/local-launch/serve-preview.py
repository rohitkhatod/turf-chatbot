#!/usr/bin/env python3
from http.server import SimpleHTTPRequestHandler, ThreadingHTTPServer
from pathlib import Path

BASE_DIR = Path(__file__).resolve().parent
THEME_DIR = (BASE_DIR / '../wordpress-theme').resolve()


class PreviewHandler(SimpleHTTPRequestHandler):
    def __init__(self, *args, **kwargs):
        super().__init__(*args, directory=str(THEME_DIR), **kwargs)

    def do_GET(self):
        if self.path in ('/', ''):
            self.path = '/preview.html'
        return super().do_GET()


if __name__ == '__main__':
    server = ThreadingHTTPServer(('0.0.0.0', 8080), PreviewHandler)
    print('Fallback preview server running at http://localhost:8080')
    server.serve_forever()
