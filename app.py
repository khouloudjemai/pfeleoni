from flask import Flask, request, render_template, redirect, jsonify
from bson import ObjectId  # Import ObjectId from bson module
from pymongo import MongoClient
import json
from flask_cors import CORS
from flask import Flask, render_template
from flask_socketio import SocketIO, emit
import time
import threading
from bson.json_util import dumps
from models.lad_model import Lad
from models.position_model import Position
from models.user_model import User
from models.post_model import Post

app = Flask(__name__)
CORS(app)
socketio = SocketIO(app, cors_allowed_origins="*")

# MongoDB connection
client = MongoClient("mongodb://localhost:27017/")
db = client["database"]
collection = db["position"]
post_collection = db["post"]  # New collection named "post"


class JSONEncoder(json.JSONEncoder):
    def default(self, o):
        if isinstance(o, ObjectId):
            return str(o)
        return json.JSONEncoder.default(self, o)

# Endpoint to insert data


@app.route('/insert', methods=['POST'])
def insert_data():
    data = request.json  # Assuming JSON data is sent
    # Insert data into MongoDB
    collection.insert_one(data)
    return jsonify({'message': 'Data inserted successfully'}), 201


@app.route('/update_qty', methods=['POST'])
def update_qty():
    data = request.json  # Assuming JSON data is sent
    Leoni_partnumber = data.get('Leoni partnumber')
    weight = data.get('Weight')
    


    if Leoni_partnumber is None or weight is None:
        return jsonify({'error': 'Customer part number or quantity per loop not provided'}), 400
    singlepeice = collection.find_one({'Leoni partnumber': Leoni_partnumber})

    if singlepeice['Leoni partnumber'] == None : 
          return jsonify({'message' :'there is no part under this number'}), 404
        
    print(singlepeice)
    singel_piece_w = float(singlepeice['Weight (gr)'].replace(',','.'))
    poid_kaba = float(singlepeice['poids_kaba'].replace(',','.'))


    qty = int((float(weight) - poid_kaba) / float(singel_piece_w))

    # Update quantity per loop for the given customer part number
    result = collection.update_one(
        {'Leoni partnumber': Leoni_partnumber},
        {'$set': {'qty per loop': qty}}
    )

    if result.modified_count == 0:
        return jsonify({'message' :'Unchanged quantities per loop'}), 200

    return jsonify({'message': 'Quantity per loop updated successfully'}), 200


# Endpoint to display data for a specific ID
@app.route('/display/<id>', methods=['GET'])
def display_data_by_id(id):
    data = []
    # Retrieve data from MongoDB for the specified ID
    cursor = collection.find({"id": int(id)}).sort("id", -1).limit(1)
    for doc in cursor:
        data.append(doc)
    return JSONEncoder().encode(data), 200

# Endpoint to display all data


@app.route('/display/all', methods=['GET'])
def display_all_data():
    data = []
    # Retrieve all data from MongoDB
    for doc in collection.find():
        data.append(doc)
    return JSONEncoder().encode(data), 200


@app.route('/update_post', methods=['POST'])
def update_post():
    data = request.json  # Assuming JSON data is sent
    print(data)
    post_number = int(data.get('post'))
    humidity = data.get('hum')
    temperature = data.get('temp')

    if post_number is None or humidity is None or temperature is None:
        return jsonify({'error': 'Post number, humidity, or temperature not provided'}), 400

    # Update humidity and temperature for the given post number
    result = post_collection.update_one(
        {'post': post_number},
        {'$set': {'hum': humidity, 'temp': temperature}}
    )

    # if result.modified_count == 0:
    #     return jsonify({'error': 'No matching document found for the provided post number'}), 404

    return jsonify({'message': 'Humidity and temperature updated successfully'}), 200


# Simulated real-time data generator
def generate_data():
    while True:
        # Generate your real-time data here
        data = "Real-time data: " + str(time.time())
        socketio.emit('realtime_data', data)
        time.sleep(1)  # Send data every second


# Start the data generator in a separate thread
thread = threading.Thread(target=generate_data)
thread.daemon = True
thread.start()


@app.route('/')
def index():
    return render_template('teste.php')

# Define a SocketIO event handler


def emit_post_data():
    while True:
        data = dumps(list(post_collection.find()))
        socketio.emit('update_post', data)
        time.sleep(1)


post_thread = threading.Thread(target=emit_post_data)
post_thread.daemon = True
post_thread.start()


def emit_data():
    data = dumps(list(collection.find()))
    socketio.emit('update', data)


@socketio.on('connect')
def handle_connect():
    emit_data()
    print('Client connected')


def listen_for_changes():
    with collection.watch() as change_stream:
        for change in change_stream:
            print("Change detected in the database")
            emit_data()


if __name__ == '__main__':
    import threading
    change_listener_thread = threading.Thread(target=listen_for_changes)
    change_listener_thread.start()
    socketio.run(app, debug=True, host="0.0.0.0", port=5000)
