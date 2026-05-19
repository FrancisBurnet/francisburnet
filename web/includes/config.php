<?php

declare(strict_types=1);

$siteName = 'MICROSOFT AI ENGINEERING PROGRAM 2026';
$siteKicker = 'Microsoft AI Engineering Portfolio';
$siteTagline = 'Capstone portfolio spanning AI engineering, applied data science, machine learning, and deep learning.';
$headerHeadshotPath = 'assets/images/francis-burnet-headshot.png';
$headerHeadshotAlt = 'Francis Burnet headshot';

$appliedDataScienceProjects = [
    [
        'key' => 'capstone-1',
        'label' => 'Capstone 1',
        'href' => 'capstone-1.php',
        'sourceFolder' => 'Capstone 1',
        'heroTitle' => 'Capstone 1 Infographic',
        'heroCaption' => 'Objective, data profile, and grading-aligned outputs for Capstone 1.',
        'summary' => 'Initial incremental capstone page for requirement-first walkthrough and outputs.',
    ],
    [
        'key' => 'capstone-2',
        'label' => 'Capstone 2',
        'href' => 'capstone-2.php',
        'sourceFolder' => 'Capstone 2',
        'heroTitle' => 'Capstone 2 Infographic',
        'heroCaption' => 'Objective, data profile, and grading-aligned outputs for Capstone 2.',
        'summary' => 'Second incremental capstone page with dedicated explanation, controls, and output areas.',
    ],
    [
        'key' => 'capstone-3',
        'label' => 'Capstone 3',
        'href' => 'capstone-3.php',
        'sourceFolder' => 'Capstone 3',
        'heroTitle' => 'Capstone 3 Infographic',
        'heroCaption' => 'Objective, data profile, and grading-aligned outputs for Capstone 3.',
        'summary' => 'Third incremental capstone page with room for notebook logic, visuals, and interaction.',
    ],
    [
        'key' => 'capstone-4',
        'label' => 'Capstone 4',
        'href' => 'capstone-4.php',
        'sourceFolder' => 'Capstone 4',
        'heroTitle' => 'Capstone 4 Infographic',
        'heroCaption' => 'Objective, data profile, and grading-aligned outputs for Capstone 4.',
        'summary' => 'Fourth incremental capstone page prepared for requirement mapping and outputs.',
    ],
];

$machineLearningProjects = [
    [
        'key' => 'capstone-session-5',
        'label' => 'Capstone 5',
        'href' => 'capstone-session-5.php',
        'sourceFolder' => 'Capstone Session 5',
        'heroTitle' => 'Capstone Session 5 Infographic',
        'heroCaption' => 'Objective, data profile, and grading-aligned outputs for Capstone Session 5.',
        'summary' => 'Session 5 capstone page for bike rental modeling and related artifacts.',
    ],
    [
        'key' => 'capstone-session-6',
        'label' => 'Capstone 6',
        'href' => 'capstone-session-6.php',
        'sourceFolder' => 'Capstone Session 6',
        'heroTitle' => 'Capstone Session 6 Infographic',
        'heroCaption' => 'Objective, data profile, and grading-aligned outputs for Capstone Session 6.',
        'summary' => 'Session 6 capstone page for income classification workflow and visuals.',
    ],
    [
        'key' => 'capstone-session-7',
        'label' => 'Capstone 7',
        'href' => 'capstone-session-7.php',
        'sourceFolder' => 'Capstone Session 7',
        'heroTitle' => 'Capstone Session 7 Infographic',
        'heroCaption' => 'Objective, data profile, and grading-aligned outputs for Capstone Session 7.',
        'summary' => 'Session 7 capstone page for clustering or segmentation work and visuals.',
    ],
    [
        'key' => 'capstone-session-8',
        'label' => 'Capstone 8',
        'href' => 'capstone-session-8.php',
        'sourceFolder' => 'Capstone Session 8',
        'heroTitle' => 'Capstone Session 8 Infographic',
        'heroCaption' => 'Objective, data profile, and grading-aligned outputs for Capstone Session 8.',
        'summary' => 'Session 8 capstone page for recommendation or ratings-based workflows.',
    ],
];

$tensorflowPlaygroundBaseUrl = 'https://playground.tensorflow.org/';
$capstone9PlaygroundPresets = [
    [
        'label' => 'Decision Boundary Basics',
        'summary' => 'Preloads a circle-classification toy dataset with `x` and `y` inputs, a tanh network shaped `4,2`, learning rate `0.03`, zero noise, and 50% train split. Press Play to watch the network learn a nonlinear boundary around the center cluster, which is the same classification idea used by the churn ANN even though this demo uses synthetic 2D points instead of bank-customer rows.',
        'url' => $tensorflowPlaygroundBaseUrl . '#activation=tanh&batchSize=10&dataset=circle&regDataset=reg-plane&learningRate=0.03&regularizationRate=0&noise=0&networkShape=4,2&seed=0.11599&showTestData=false&discretize=false&percTrainData=50&x=true&y=true&xTimesY=false&xSquared=false&ySquared=false&cosX=false&sinX=false&cosY=false&sinY=false&collectStats=false&problem=classification&initZero=false&hideText=true',
    ],
    [
        'label' => 'Hidden Layers On Spiral Data',
        'summary' => 'Preloads the spiral dataset with a deeper `8,6,4` tanh network so you can see why extra hidden-layer capacity helps on more complex class boundaries. Use this to compare a simple ANN versus a deeper one and watch how training takes longer but can represent more complicated separation patterns.',
        'url' => $tensorflowPlaygroundBaseUrl . '#activation=tanh&batchSize=10&dataset=spiral&regDataset=reg-plane&learningRate=0.03&regularizationRate=0&noise=0&networkShape=8,6,4&seed=0.11599&showTestData=false&discretize=false&percTrainData=50&x=true&y=true&xTimesY=false&xSquared=false&ySquared=false&cosX=false&sinX=false&cosY=false&sinY=false&collectStats=false&problem=classification&initZero=false&hideText=true',
    ],
    [
        'label' => 'ReLU On XOR',
        'summary' => 'Preloads the XOR dataset with a `6,3` ReLU network so you can compare activation choice and topology. Press Play and watch the network solve a pattern that a linear model cannot separate, which mirrors why hidden layers and nonlinear activations matter in ANN-based classification.',
        'url' => $tensorflowPlaygroundBaseUrl . '#activation=relu&batchSize=10&dataset=xor&regDataset=reg-plane&learningRate=0.03&regularizationRate=0&noise=0&networkShape=6,3&seed=0.11599&showTestData=false&discretize=false&percTrainData=50&x=true&y=true&xTimesY=false&xSquared=false&ySquared=false&cosX=false&sinX=false&cosY=false&sinY=false&collectStats=false&problem=classification&initZero=false&hideText=true',
    ],
    [
        'label' => 'Regularization Under Noise',
        'summary' => 'Preloads Gaussian classification data with 15% noise, visible test points, and regularization rate `0.001`. Press Play and compare how the learned boundary stays smoother under noisy data, which is useful for explaining generalization and overfitting risk in the churn project.',
        'url' => $tensorflowPlaygroundBaseUrl . '#activation=tanh&batchSize=10&dataset=gauss&regDataset=reg-plane&learningRate=0.03&regularizationRate=0.001&noise=15&networkShape=6,3&seed=0.11599&showTestData=true&discretize=false&percTrainData=50&x=true&y=true&xTimesY=false&xSquared=false&ySquared=false&cosX=false&sinX=false&cosY=false&sinY=false&collectStats=false&problem=classification&initZero=false&hideText=true',
    ],
];

$capstone10PlaygroundPresets = [
    [
        'label' => 'Decision Boundary Basics',
        'summary' => 'Uses the same circle dataset and compact tanh network, but here the value is intuition for binary image classification: the model starts with a simple class split and gradually learns a curved separation, similar to how a mask-vs-no-mask classifier must learn a nonlinear boundary instead of relying on one obvious pixel rule.',
        'url' => $capstone9PlaygroundPresets[0]['url'],
    ],
    [
        'label' => 'Hidden Layers On Spiral Data',
        'summary' => 'Uses a deeper `8,6,4` tanh network on the spiral dataset to show why extra representational capacity helps on harder visual patterns. This is the closest preset to the feature-hierarchy idea behind the CNN models in the face-mask project, where deeper layers help separate more complex structures.',
        'url' => $capstone9PlaygroundPresets[1]['url'],
    ],
    [
        'label' => 'ReLU On XOR',
        'summary' => 'Uses a ReLU network on XOR to show how nonlinear activations unlock separations that a shallow linear rule cannot achieve. That maps well to the face-mask project because image classifiers also depend on stacked nonlinear transformations rather than a single linear threshold over raw inputs.',
        'url' => $capstone9PlaygroundPresets[2]['url'],
    ],
    [
        'label' => 'Regularization Under Noise',
        'summary' => 'Adds Gaussian noise and regularization so you can watch the boundary stay smoother instead of chasing every noisy point. For the mask-detection project, this is the closest analogy to controlling overfitting when image backgrounds, lighting, and framing vary across examples.',
        'url' => $capstone9PlaygroundPresets[3]['url'],
    ],
];

$capstone11PlaygroundPresets = [
    [
        'label' => 'Decision Boundary Basics',
        'summary' => 'Starts with a compact tanh classifier on the circle dataset so you can see how a model gradually forms a usable separation. For the review-analysis capstone, this stands in for the final classifier stage that acts on learned text features, even though the playground uses 2D synthetic points instead of token sequences.',
        'url' => $capstone9PlaygroundPresets[0]['url'],
    ],
    [
        'label' => 'Hidden Layers On Spiral Data',
        'summary' => 'Uses a deeper network on a harder spiral problem to illustrate why more capacity can help with tangled patterns. That is useful here as a conceptual bridge to sequence models, where the network needs richer internal representations before it can separate subtle language signals like sentiment or grammatical structure.',
        'url' => $capstone9PlaygroundPresets[1]['url'],
    ],
    [
        'label' => 'ReLU On XOR',
        'summary' => 'Shows a ReLU network solving XOR, a classic example of a problem that needs nonlinear feature combinations. That directly supports the Session 11 story: text tasks often depend on interactions between features rather than any one token or score acting alone.',
        'url' => $capstone9PlaygroundPresets[2]['url'],
    ],
    [
        'label' => 'Regularization Under Noise',
        'summary' => 'Uses noisy Gaussian data with regularization to show how the model avoids overreacting to messy inputs. In the review-analysis capstone, that is the best analogy here for handling noisy language patterns, uneven phrasing, and generalization beyond memorized training examples.',
        'url' => $capstone9PlaygroundPresets[3]['url'],
    ],
];

$capstone12PlaygroundPresets = [
    [
        'label' => 'Decision Boundary Basics',
        'summary' => 'Begins with a simple nonlinear classifier so you can see how hidden units reshape the feature space. Session 12 is an autoencoder rather than a classifier, but this still helps explain the core idea that hidden layers learn internal representations instead of preserving the raw input structure unchanged.',
        'url' => $capstone9PlaygroundPresets[0]['url'],
    ],
    [
        'label' => 'Hidden Layers On Spiral Data',
        'summary' => 'Uses a deeper network on the spiral dataset to show how multiple hidden layers can capture more complex structure. That is the closest playground analogy to the encoder-decoder stack in the dental project, where compressed hidden representations are needed before the model can reconstruct cleaner outputs.',
        'url' => $capstone9PlaygroundPresets[1]['url'],
    ],
    [
        'label' => 'ReLU On XOR',
        'summary' => 'Uses ReLU activations on XOR to show how learned nonlinear transformations create a more useful internal feature space. For the denoising autoencoder, this supports the idea that the network must transform the input into a richer hidden representation before it can recover the cleaner signal.',
        'url' => $capstone9PlaygroundPresets[2]['url'],
    ],
    [
        'label' => 'Regularization Under Noise',
        'summary' => 'Adds noise and regularization so you can compare a smoother, less overfit response to messy data. That makes this preset the most directly relevant one for Session 12 because the notebook is also about learning stable structure in the presence of deliberately corrupted inputs.',
        'url' => $capstone9PlaygroundPresets[3]['url'],
    ],
];

$deepLearningProjects = [
    [
        'key' => 'capstone-session-9',
        'label' => 'Capstone 9',
        'href' => 'capstone-session-9.php',
        'sourceFolder' => 'Capstone Session 9',
        'heroTitle' => 'Capstone Session 9 Infographic',
        'heroCaption' => 'Objective, data profile, and grading-aligned outputs for Capstone Session 9.',
        'summary' => 'Session 9 deep learning capstone page for churn modeling and related artifacts.',
        'interactiveLab' => [
            'enabled' => true,
            'heading' => 'Interactive Neural Network Lab',
            'summary' => 'This TensorFlow Playground embed is a concept simulator for the ANN ideas behind the churn project. It does not load `Churn_Modeling.csv`; instead, it preloads small synthetic classification datasets and network settings so you can watch how hidden layers, activations, learning rate, and regularization change the learned decision boundary.',
            'context' => [
                'The embedded lab is not the graded Session 9 model and does not use the bank churn dataset from the notebook.',
                'What is preloaded depends on the preset button you click: each preset swaps in a synthetic dataset, activation, network shape, learning rate, train split, and noise setting.',
                'The right-hand plot shows the model output over the 2D feature space, while the loss values at the top tell you whether training is improving.',
            ],
            'instructions' => [
                'Click any preset button above the embed to load that preconfigured scenario into the playground frame.',
                'Press the Play button in the top-left corner of the playground to start training the network.',
                'Watch the epoch counter, loss readout, and colored output panel update as the model learns.',
                'Switch to another preset to compare how a different dataset or network design changes the training behavior.',
            ],
            'expectations' => [
                'Decision Boundary Basics: expect a smooth boundary forming around the center cluster as the tanh network converges.',
                'Hidden Layers On Spiral Data: expect a harder problem that needs more epochs and more capacity to untangle the spiral arms.',
                'ReLU On XOR: expect the network to learn a nonlinear separation that a simple linear separator cannot produce.',
                'Regularization Under Noise: expect noisier points and a smoother boundary, which helps explain overfitting control.',
            ],
            'note' => 'These four buttons are preset loaders, not dead tabs. Clicking one reloads the embedded playground with a different preconfigured dataset and network. The actual graded evidence for Session 9 still comes from the notebook, the training-history plot, the confusion matrix, and the exported churn-prediction outputs.',
            'embedUrl' => $capstone9PlaygroundPresets[0]['url'],
            'launchUrl' => $tensorflowPlaygroundBaseUrl,
            'launchLabel' => 'Open Full Playground',
            'presets' => $capstone9PlaygroundPresets,
        ],
    ],
    [
        'key' => 'capstone-session-10',
        'label' => 'Capstone 10',
        'href' => 'capstone-session-10.php',
        'sourceFolder' => 'Capstone Session 10',
        'heroTitle' => 'Capstone Session 10 Infographic',
        'heroCaption' => 'Objective, data profile, and grading-aligned outputs for Capstone Session 10.',
        'summary' => 'Session 10 deep learning capstone page for face mask detection assets and workflows.',
        'interactiveLab' => [
            'enabled' => true,
            'heading' => 'Interactive Neural Network Lab',
            'summary' => 'This TensorFlow Playground embed is a concept sandbox for the classification behavior behind the face-mask project. It does not load the image dataset or run the CNN notebook; instead, it preloads small synthetic problems that make depth, activation choice, and regularization easier to see before you compare them to the real Session 10 training plots and predictions.',
            'context' => [
                'The playground does not run the actual mask-detection model and does not use image pixels from the capstone dataset.',
                'Each preset loads a different synthetic dataset and network configuration so you can compare simple versus harder classification behavior.',
                'Use it as a visual analogy for why deeper networks and nonlinear activations matter before you return to the real CNN outputs on the page.',
            ],
            'instructions' => [
                'Read the preset card closest to the behavior you want to compare, then click its Load button just above the playground.',
                'Press the top-left Play button inside the playground to start training that preset.',
                'Watch the loss and the colored decision regions change as the model learns the class boundary.',
                'Switch presets to compare simple separation, deeper capacity, nonlinear activations, and regularization under noisy conditions.',
            ],
            'expectations' => [
                'Decision Boundary Basics: expect a clean nonlinear split that introduces the basic binary-classification idea.',
                'Hidden Layers On Spiral Data: expect a more difficult pattern that shows why extra model capacity helps.',
                'ReLU On XOR: expect a clear example of why nonlinear activations matter for learnable separation.',
                'Regularization Under Noise: expect a smoother boundary that supports the overfitting discussion behind image-model generalization.',
            ],
            'note' => 'Use these presets as short visual analogies for the Session 10 classifier. They explain why deeper networks, nonlinear activations, and smoother boundaries matter, but they do not replace the real capstone evidence, which still comes from the notebook, screenshots, training-history plots, model comparison, and prediction artifacts.',
            'embedUrl' => $capstone9PlaygroundPresets[1]['url'],
            'launchUrl' => $tensorflowPlaygroundBaseUrl,
            'launchLabel' => 'Open Full Playground',
            'presets' => $capstone10PlaygroundPresets,
        ],
    ],
    [
        'key' => 'capstone-session-11',
        'label' => 'Capstone 11',
        'href' => 'capstone-session-11.php',
        'sourceFolder' => 'Capstone Session 11',
        'heroTitle' => 'Capstone Session 11 Infographic',
        'heroCaption' => 'Objective, data profile, and grading-aligned outputs for Capstone Session 11.',
        'summary' => 'Session 11 deep learning capstone page for grammar and product review analysis.',
        'interactiveLab' => [
            'enabled' => true,
            'heading' => 'Interactive Neural Network Lab',
            'summary' => 'This TensorFlow Playground embed is a concept sandbox for the representation-learning ideas that sit underneath the Session 11 sequence-model work. It does not load review text, embeddings, or the CNN-LSTM notebook; instead, it uses synthetic datasets to make hidden-layer capacity, nonlinearity, and regularization easier to understand before you return to the real text-model outputs.',
            'context' => [
                'The playground is not a sequence model and does not run the actual product-review or grammar workflow from the notebook.',
                'What it does show well is how a network transforms inputs into more separable internal representations before a final classifier makes a decision.',
                'That is the reason it belongs on this page: it helps explain the network behavior conceptually, even though the notebook evidence still lives in the real text-model artifacts.',
            ],
            'instructions' => [
                'Choose a preset card above the playground based on the concept you want to see: basic separation, extra capacity, nonlinear features, or regularization.',
                'Click the preset Load button and then press the Play button inside the playground.',
                'Watch how the output region changes over epochs and how difficult patterns need richer internal structure to separate cleanly.',
                'Use the presets as analogies for what the deeper review-analysis model is doing with learned features under the hood.',
            ],
            'expectations' => [
                'Decision Boundary Basics: expect the simplest demonstration of a network creating a usable class split.',
                'Hidden Layers On Spiral Data: expect the best illustration of why tangled patterns need more representational depth.',
                'ReLU On XOR: expect a compact example of feature interaction and nonlinearity.',
                'Regularization Under Noise: expect a useful analogy for keeping the model from overfitting noisy language signals.',
            ],
            'note' => 'Use these presets to build intuition for how a network forms richer internal features before making a final decision. They are concept support only; the graded Session 11 evidence still comes from the notebook, screenshots, exported outputs, and walkthrough content tied to the real review-analysis workflow.',
            'embedUrl' => $capstone9PlaygroundPresets[2]['url'],
            'launchUrl' => $tensorflowPlaygroundBaseUrl,
            'launchLabel' => 'Open Full Playground',
            'presets' => $capstone11PlaygroundPresets,
        ],
    ],
    [
        'key' => 'capstone-session-12',
        'label' => 'Capstone 12',
        'href' => 'capstone-session-12.php',
        'sourceFolder' => 'Capstone Session 12',
        'heroTitle' => 'Capstone Session 12 Infographic',
        'heroCaption' => 'Objective, data profile, and grading-aligned outputs for Capstone Session 12.',
        'summary' => 'Session 12 deep learning capstone page for panoramic dental autoencoder artifacts.',
        'interactiveLab' => [
            'enabled' => true,
            'heading' => 'Interactive Neural Network Lab',
            'summary' => 'This TensorFlow Playground embed is a concept sandbox for the hidden-representation ideas behind the dental autoencoder capstone. It does not run the denoising autoencoder or use the panoramic image data; instead, it uses synthetic problems to make hidden-layer transformation, network depth, and stability under noise easier to inspect before you compare them to the real Session 12 reconstruction outputs.',
            'context' => [
                'The playground is still a classifier demo, so it is not a direct autoencoder replica.',
                'Its value on this page is conceptual: it lets you watch how hidden layers reshape inputs into more useful internal structure before the model produces an output.',
                'That is closely related to the Session 12 encoder-decoder idea, where the network must learn a stable internal representation before reconstructing the cleaner image.',
            ],
            'instructions' => [
                'Pick a preset card above the playground and load it just before the iframe.',
                'Press Play inside the playground to train that scenario and watch how the hidden layers change the learned output surface.',
                'Use the deeper and noisy presets to connect what you see here to the encoder depth and denoising goals in the notebook.',
                'Return to the Session 12 reconstruction plots afterward to connect the concept demo back to the actual autoencoder evidence.',
            ],
            'expectations' => [
                'Decision Boundary Basics: expect the clearest first look at how hidden layers reshape a simple problem.',
                'Hidden Layers On Spiral Data: expect the strongest analogy for deeper latent representations capturing harder structure.',
                'ReLU On XOR: expect a compact example of useful nonlinear transformation in hidden space.',
                'Regularization Under Noise: expect the closest conceptual match to the denoising goal in the real capstone.',
            ],
            'note' => 'Use these presets to build intuition for how a model can learn stable internal structure from noisy inputs. They are concept support only; the real Session 12 evidence still comes from the notebook, screenshots, training history, and denoising artifacts saved with the project.',
            'embedUrl' => $capstone9PlaygroundPresets[3]['url'],
            'launchUrl' => $tensorflowPlaygroundBaseUrl,
            'launchLabel' => 'Open Full Playground',
            'presets' => $capstone12PlaygroundPresets,
        ],
    ],
];

$appliedDataScienceProjects = array_map(
    static fn(array $project): array => $project + ['programFolder' => 'Applied Data Science with Python'],
    $appliedDataScienceProjects
);

$machineLearningProjects = array_map(
    static fn(array $project): array => $project + ['programFolder' => 'Machine Learning Using Python'],
    $machineLearningProjects
);

$deepLearningProjects = array_map(
    static fn(array $project): array => $project + ['programFolder' => 'Deep Learning Specialization'],
    $deepLearningProjects
);

$capstoneProjects = array_merge(
    $appliedDataScienceProjects,
    $machineLearningProjects,
    $deepLearningProjects
);

$capstoneProgramGroups = [
    [
        'label' => 'Applied Data Science',
        'anchor' => 'applied-data-science',
        'summary' => 'Capstones 1 through 4 from the applied data science track.',
        'children' => $appliedDataScienceProjects,
    ],
    [
        'label' => 'Machine Learning',
        'anchor' => 'machine-learning',
        'summary' => 'Capstones 5 through 8 from the machine learning track.',
        'children' => $machineLearningProjects,
    ],
    [
        'label' => 'Deep Learning',
        'anchor' => 'deep-learning',
        'summary' => 'Capstones 9 through 12 from the deep learning track.',
        'children' => $deepLearningProjects,
    ],
];

$publishedProjectProgramGroups = [
    [
        'label' => 'Applied Data Science',
        'anchor' => 'projects-applied-data-science',
        'summary' => 'Published end-of-class projects for the applied data science track.',
        'programFolder' => 'Applied Data Science with Python',
        'children' => [
            [
                'key' => 'applied-data-science-placeholder',
                'label' => 'Applied Data Science Projects',
                'href' => 'projects.php#projects-applied-data-science',
                'status' => 'Planned',
                'summary' => 'Placeholder for future published projects from the applied data science course sequence.',
                'available' => false,
            ],
        ],
    ],
    [
        'label' => 'Machine Learning',
        'anchor' => 'projects-machine-learning',
        'summary' => 'Published end-of-class projects for the machine learning track.',
        'programFolder' => 'Machine Learning Using Python',
        'children' => [
            [
                'key' => 'machine-learning-placeholder',
                'label' => 'Machine Learning Projects',
                'href' => 'projects.php#projects-machine-learning',
                'status' => 'Planned',
                'summary' => 'Placeholder for future published projects from the machine learning course sequence.',
                'available' => false,
            ],
        ],
    ],
    [
        'label' => 'Deep Learning',
        'anchor' => 'projects-deep-learning',
        'summary' => 'Published end-of-class projects for the deep learning track.',
        'programFolder' => 'Deep Learning Specialization',
        'children' => [
            [
                'key' => 'automating-port-operations',
                'label' => 'Automating Port Operations',
                'publicTitle' => 'Vessel Type Classifier for Port Operations',
                'href' => 'projects.php#projects-deep-learning',
                'status' => 'In Planning',
                'summary' => 'First published Projects entry. This deep learning project will pair the graded notebook evidence with a browser-based vessel classification demo.',
                'available' => false,
            ],
        ],
    ],
    [
        'label' => 'Python For AI',
        'anchor' => 'projects-python-for-ai',
        'summary' => 'Published end-of-class projects for the Python for AI track.',
        'programFolder' => 'Python for AI',
        'children' => [
            [
                'key' => 'python-for-ai-placeholder',
                'label' => 'Python For AI Projects',
                'href' => 'projects.php#projects-python-for-ai',
                'status' => 'Planned',
                'summary' => 'Placeholder for future published projects from the Python for AI course sequence.',
                'available' => false,
            ],
        ],
    ],
];

$publishedProjects = array_merge(
    ...array_map(
        static fn(array $group): array => array_map(
            static fn(array $project): array => $project + [
                'programLabel' => $group['label'],
                'programFolder' => $group['programFolder'],
                'groupAnchor' => $group['anchor'],
            ],
            $group['children']
        ),
        $publishedProjectProgramGroups
    )
);

$navItems = [
    ['label' => 'Home', 'href' => 'index.php'],
    ['label' => 'About', 'href' => 'about.php'],
    ['label' => 'Incremental Capstone', 'href' => 'incremental-capstone.php', 'children' => $capstoneProgramGroups],
    ['label' => 'Projects', 'href' => 'projects.php', 'children' => $publishedProjectProgramGroups, 'overviewLabel' => 'All Projects'],
    ['label' => 'Contact', 'href' => 'contact.php'],
];

$legalItems = [
    ['label' => 'Disclaimer', 'href' => 'disclaimer.php'],
    ['label' => 'Privacy', 'href' => 'privacy.php'],
    ['label' => 'Terms of Use', 'href' => 'terms.php'],
    ['label' => 'Copyright', 'href' => 'copyright.php'],
];

$contactEmail = 'hello@francisburnet.com';
$contactLinkedInUrl = 'https://linkedin.com/in/francisburnet';
$contactLinkedInLabel = 'linkedin.com/in/francisburnet';
$contactMailingAddress = 'PO Box 1381, Bellmawr, NJ 08099';

$githubNotebookBaseUrl = 'https://github.com/FrancisBurnet/francisburnet/blob/main/';
$colabNotebookBaseUrl = 'https://colab.research.google.com/github/FrancisBurnet/francisburnet/blob/main/';
$colabNotebookRepoPaths = [
    'capstone-1' => 'Incremental%20Capstones/Applied%20Data%20Science%20with%20Python/Capstone%201/capstone_1_colab_verification.ipynb',
    'capstone-2' => 'Incremental%20Capstones/Applied%20Data%20Science%20with%20Python/Capstone%202/capstone_2.ipynb',
    'capstone-3' => 'Incremental%20Capstones/Applied%20Data%20Science%20with%20Python/Capstone%203/capstone_3.ipynb',
    'capstone-4' => 'Incremental%20Capstones/Applied%20Data%20Science%20with%20Python/Capstone%204/capstone_4.ipynb',
    'capstone-session-5' => 'Incremental%20Capstones/Machine%20Learning%20Using%20Python/Capstone%20Session%205/capstone_session_5.ipynb',
    'capstone-session-6' => 'Incremental%20Capstones/Machine%20Learning%20Using%20Python/Capstone%20Session%206/capstone_session_6.ipynb',
    'capstone-session-7' => 'Incremental%20Capstones/Machine%20Learning%20Using%20Python/Capstone%20Session%207/capstone_session_7.ipynb',
    'capstone-session-8' => 'Incremental%20Capstones/Machine%20Learning%20Using%20Python/Capstone%20Session%208/capstone_session_8.ipynb',
    'capstone-session-9' => 'Incremental%20Capstones/Deep%20Learning%20Specialization/Capstone%20Session%209/capstone_session_9.ipynb',
    'capstone-session-10' => 'Incremental%20Capstones/Deep%20Learning%20Specialization/Capstone%20Session%2010/capstone_session_10.ipynb',
    'capstone-session-11' => 'Incremental%20Capstones/Deep%20Learning%20Specialization/Capstone%20Session%2011/capstone_session_11.ipynb',
    'capstone-session-12' => 'Incremental%20Capstones/Deep%20Learning%20Specialization/Capstone%20Session%2012/capstone_session_12.ipynb',
];

$colabVerificationConfig = [];
foreach ($colabNotebookRepoPaths as $capstoneKey => $repoPath) {
    $envSuffix = strtoupper(str_replace('-', '_', $capstoneKey));
    $defaultSourceUrl = $githubNotebookBaseUrl . $repoPath;
    $defaultLaunchUrl = $colabNotebookBaseUrl . $repoPath;

    $colabVerificationConfig[$capstoneKey] = [
        'launchUrl' => getenv('COLAB_' . $envSuffix . '_LAUNCH_URL') ?: $defaultLaunchUrl,
        'publicNotebookSourceUrl' => getenv('COLAB_' . $envSuffix . '_NOTEBOOK_SOURCE_URL') ?: $defaultSourceUrl,
        'publicDatasetMirrorUrl' => getenv('COLAB_' . $envSuffix . '_DATASET_MIRROR_URL') ?: null,
    ];
}
