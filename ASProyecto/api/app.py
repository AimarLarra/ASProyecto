from flask import Flask, jsonify
import requests

app = Flask(__name__)

NEWS_API_KEY = "de68ff235aa644f3b4c46ab48c505f36"  

@app.route('/get_news')
def get_news():
    # Get top headlines from News API
    url = f'https://newsapi.org/v2/top-headlines?country=us&apiKey=de68ff235aa644f3b4c46ab48c505f36'
    response = requests.get(url)
    data = response.json()

    # Extract relevant information
    articles = data.get('articles', [])

    # Render the home template with the list of articles
    return jsonify(articles)

if __name__ == '__main__':
    app.run(host='0.0.0.0', debug=True)
