import logging
import os
import tensorflow as tf
logger = tf.get_logger()
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '3'  # FATAL
logger.setLevel(logging.ERROR)
import numpy as np
import matplotlib.pyplot as plt
from keras.preprocessing import image
from keras.preprocessing.image import ImageDataGenerator, img_to_array, load_img, array_to_img
from tensorflow.keras.models import load_model

model=load_model('Garbage.h5')

labels = {0: 'cardboard', 1: 'glass', 2: 'metal', 3: 'paper', 4: 'plastic', 5: 'trash'}

img_path = input()

img = image.load_img(img_path, target_size=(300, 300))
img = image.img_to_array(img, dtype=np.uint8)
img=np.array(img)/255.0

p=model.predict(img[np.newaxis, ...])
print(img_path)
#print("Predicted shape",p.shape)
print(">",np.max(p[0], axis=-1))
predicted_class = labels[np.argmax(p[0], axis=-1)]
print(">",np.argmax(p[0], axis=-1))
