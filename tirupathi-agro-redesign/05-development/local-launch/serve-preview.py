#!/usr/bin/env python3
from http.server import SimpleHTTPRequestHandler, ThreadingHTTPServer
from pathlib import Path
import os

BASE_DIR = Path(__file__).resolve().parent
THEME_DIR = (BASE_DIR / '../wordpress-theme').resolve()


class PreviewHandler(SimpleHTTPRequestHandler):
    def __init__(self, *args, **kwargs):
        super().__init__(*args, directory=str(THEME_DIR), **kwargs)

    def do_GET(self):
        if self.path == '/__preview_health':
            body = f'tirupathi-preview:{os.getpid()}'.encode('ascii')
            self.send_response(200)
            self.send_header('Content-Type', 'text/plain')
            self.send_header('Content-Length', str(len(body)))
            self.send_header('Cache-Control', 'no-store')
            self.end_headers()
            self.wfile.write(body)
            return
        if self.path in ('/', ''):
            self.path = '/preview.html'
        return super().do_GET()


if __name__ == '__main__':
    server = ThreadingHTTPServer(('0.0.0.0', 8080), PreviewHandler)
    print('Fallback preview server running at http://localhost:8080')
    server.serve_forever()
