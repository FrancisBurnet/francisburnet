# Automating Port Operations Requirements

Source document: `1714053668_project_automating_port_operations.docx`

## Extraction Summary

- Major project sections detected: 3
- Actionable requirements created: 35
- Numbering style applied: `1a, 1b, 1c ... 2a, 2b ... 3a`
- Note: the requirement text below is intentionally kept verbatim from the problem statement as closely as possible. Source wording, capitalization, and typos are preserved intentionally instead of being translated, corrected, or shortened.

## 1. Custom CNN Model Tasks

1a. - [ ] Build a CNN network to classify the boat.
1b. - [ ] Split the dataset into train and test in the ratio 80:20, with shuffle and random state=43.
1c. - [ ] Use tf.keras.preprocessing.image_dataset_from_directory to load the train and test datasets. This function also supports data normalization. (Hint: image_scale=1./255).
1d. - [ ] Load train, validation and test dataset in batches of 32 using the function initialized in the above step.
1e. - [ ] Build a CNN network using Keras with the following layers.
1f. - [ ] Cov2D with 32 filters, kernel size 3,3, and activation relu, followed by MaxPool2D.
1g. - [ ] Cov2D with 32 filters, kernel size 3,3, and activation relu, followed by MaxPool2D.
1h. - [ ] GLobalAveragePooling2D layer.
1i. - [ ] Dense layer with 128 neurons and activation relu.
1j. - [ ] Dense layer with 128 neurons and activation relu.
1k. - [ ] Dense layer with 9 neurons and activation softmax.
1l. - [ ] Compile the model with Adam optimizer, categorical_crossentropy loss, and with metrics accuracy, precision, and recall.
1m. - [ ] Train the model for 20 epochs and plot training loss and accuracy against epochs.
1n. - [ ] Evaluate the model on test images and print the test loss and accuracy.
1o. - [ ] Plot heatmap of the confusion matrix and print classification report.

## 2. Transfer Learning Model Tasks

2a. - [ ] Build a lightweight model with the aim of deploying the solution on a mobile device using transfer learning. You can use any lightweight pre-trained model as the initial (first) layer. MobileNetV2 is a popular lightweight pre-trained model built using Keras API.
2b. - [ ] Split the dataset into train and test datasets in the ration 70:30, with shuffle and random state=1.
2c. - [ ] Use tf.keras.preprocessing.image_dataset_from_directory to load the train and test datasets. This function also supports data normalization. (Hint: Image_scale=1./255).
2d. - [ ] Load train, validation and test datasets in batches of 32 using the function initialized in the above step.
2e. - [ ] Build a CNN network using Keras with the following layers.
2f. - [ ] Load MobileNetV2 - Light Model as the first layer (Hint: Keras API Doc).
2g. - [ ] GLobalAveragePooling2D layer.
2h. - [ ] Dropout(0.2).
2i. - [ ] Dense layer with 256 neurons and activation relu.
2j. - [ ] BatchNormalization layer.
2k. - [ ] Dropout(0.1).
2l. - [ ] Dense layer with 128 neurons and activation relu.
2m. - [ ] BatchNormalization layer.
2n. - [ ] Dropout(0.1).
2o. - [ ] Dense layer with 9 neurons and activation softmax.
2p. - [ ] Compile the model with Adam optimizer, categorical_crossentropy loss, and metrics accuracy, Precision, and Recall.
2q. - [ ] Train the model for 50 epochs and Early stopping while monitoring validation loss.
2r. - [ ] Evaluate the model on test images and print the test loss and accuracy.
2s. - [ ] Plot Train loss Vs Validation loss and Train accuracy Vs Validation accuracy.

## 3. Final Comparison Task

3a. - [ ] Compare the results of both models built in steps 1 and 2 and state your observations.