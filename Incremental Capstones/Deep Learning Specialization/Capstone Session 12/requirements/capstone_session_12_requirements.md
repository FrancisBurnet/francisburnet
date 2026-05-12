# Capstone Session 12 Requirements

Source directions file: `Capstone_Session_12.pdf`
Source staged dataset: `Dental-Panaromic-Autoencoder.npz`

## 1. Enhancing Dental X-rays with Autoencoders

1a. Build an autoencoder model to improve the clarity of dental X-rays by denoising the panoramic dental dataset.
Status: The copied PDF states this modeling objective explicitly. No staged notebook, trained autoencoder, or plot artifact is currently present.

1b. Load `Dental-Panaromic-Autoencoder.npz` using `NumPy.load`.
Status: Supported by the copied dataset staged in this capstone folder.

1c. Extract `x_train`, `y_train`, `x_test`, and `y_test` NumPy arrays from the dataset.
Status: Supported by the staged dataset archive, which contains arrays `x_train`, `y_train`, `x_test`, and `y_test`.

1d. Create a noisy version of the dataset by applying random noise to each image.
Status: This PDF requirement is identified from the copied directions file. No staged noisy-image artifact is currently present.

1e. With a noise factor of `0.2`, add noise to the signal by multiplying the noise factor and random values from a normal distribution.
Status: The copied PDF states this noise-generation step explicitly. No staged noisy-image artifact is currently present.

1f. Clip the signal values between 0 and 1.
Status: This PDF requirement is identified from the copied directions file. No staged clipped-image artifact is currently present.

1g. Plot the first 5 X-ray images from the original images (`x_train`).
Status: Supported by the staged array `x_train` with shape `(92, 256, 256, 3)`. No staged figure artifact is currently present.

1h. Plot the first 5 X-ray images from the noisy images (`x_train_noisy`).
Status: This PDF requirement is identified from the copied directions file. No staged figure artifact is currently present.

1i. Train an autoencoder using the noisy image as the input and the original image as the destination, with images shaped `256x256` in RGB scale.
Status: Supported by the staged array shape `(92, 256, 256, 3)` for `x_train`. No staged training artifact is currently present.

1j. Create a `Denoise` class inherited from `Keras Model`.
Status: This PDF requirement is identified from the copied directions file. No staged model-class artifact is currently present.

1k. Define the encoder with an input layer of shape `256*256*3`.
Status: This PDF requirement is identified from the copied directions file. No staged encoder artifact is currently present.

1l. Add a `Conv2D` layer with 64 filters, kernel size `3,3`, activation `relu`, same padding, and stride 2 to the encoder.
Status: This PDF requirement is identified from the copied directions file. No staged encoder artifact is currently present.

1m. Add a `Conv2D` layer with 32 filters, kernel size `3,3`, activation `relu`, same padding, and stride 2 to the encoder.
Status: This PDF requirement is identified from the copied directions file. No staged encoder artifact is currently present.

1n. Add a `Conv2DTranspose` layer with 32 filters, kernel size `3,3`, activation `relu`, same padding, and stride 2 to the decoder.
Status: This PDF requirement is identified from the copied directions file. No staged decoder artifact is currently present.

1o. Add a `Conv2DTranspose` layer with 64 filters, kernel size `3,3`, activation `relu`, same padding, and stride 2 to the decoder.
Status: This PDF requirement is identified from the copied directions file. No staged decoder artifact is currently present.

1p. Add a `Conv2D` layer with 1 filter, kernel size `3,3`, activation `sigmoid`, and same padding to the decoder.
Status: This PDF requirement is identified from the copied directions file. No staged decoder artifact is currently present.

1q. Create a `call` member function that passes the input to the encoder and the encoder output to the decoder.
Status: This PDF requirement is identified from the copied directions file. No staged model-class artifact is currently present.

1r. Initialize the autoencoder object of class `Denoise`.
Status: This PDF requirement is identified from the copied directions file. No staged model-init artifact is currently present.

1s. Compile the autoencoder with Adam optimizer and `MeanSquaredError` as loss.
Status: This PDF requirement is identified from the copied directions file. No staged compiled-model artifact is currently present.

1t. Train the autoencoder with `X = x_train_noisy` and `Y = x_train` for 50 epochs using validation data `x_test_noisy` and `x_test`.
Status: This PDF requirement is identified from the copied directions file. No staged training artifact is currently present.

1u. Plot training and validation MAE and loss against epochs.
Status: This PDF requirement is identified from the copied directions file. No staged figure artifact is currently present.

1v. Evaluate the autoencoder model on `x_test`.
Status: Supported by the staged array `x_test` with shape `(24, 256, 256, 3)`. No staged evaluation artifact is currently present.

1w. Pass `x_test` into the encoder.
Status: This PDF requirement is identified from the copied directions file. No staged encoded-image artifact is currently present.

1x. Pass the encoded images into the decoder to produce reconstructed images.
Status: This PDF requirement is identified from the copied directions file. No staged decoded-image artifact is currently present.

1y. Plot the first 10 noisy images (`x_test_noisy`) and the denoised images produced by the autoencoder.
Status: This PDF requirement is identified from the copied directions file. No staged denoising figure artifact is currently present.

1z. Check how well the autoencoder has performed the denoising task.
Status: This PDF requirement is identified from the copied directions file. No staged denoising assessment artifact is currently present.

## Requirements Extraction Counts
- Actionable PDF requirement items extracted from the copied Capstone Session 12 directions file: 26
- Dataset-backed items currently supported by staged source files in this capstone folder: 5
- PDF-only items still awaiting notebook, model, figure, or evaluation evidence: 21