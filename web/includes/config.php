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
            'summary' => 'TensorFlow Playground supports the neural network concepts behind the face mask detection workflow on this page.',
            'note' => 'This lab is an optional concept sandbox. The capstone evidence still comes from the notebook, screenshots, exported outputs, and walkthrough blocks.',
            'embedUrl' => $capstone9PlaygroundPresets[1]['url'],
            'launchUrl' => $tensorflowPlaygroundBaseUrl,
            'launchLabel' => 'Open Full Playground',
            'presets' => $capstone9PlaygroundPresets,
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
            'summary' => 'TensorFlow Playground provides a quick neural network concept lab alongside the sequence-model work collected for this capstone.',
            'note' => 'This lab is an optional concept sandbox. The capstone evidence still comes from the notebook, screenshots, exported outputs, and walkthrough blocks.',
            'embedUrl' => $capstone9PlaygroundPresets[2]['url'],
            'launchUrl' => $tensorflowPlaygroundBaseUrl,
            'launchLabel' => 'Open Full Playground',
            'presets' => $capstone9PlaygroundPresets,
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
            'summary' => 'TensorFlow Playground adds an interactive neural network view that fits the representation-learning concepts used in the autoencoder capstone.',
            'note' => 'This lab is an optional concept sandbox. The capstone evidence still comes from the notebook, screenshots, exported outputs, and walkthrough blocks.',
            'embedUrl' => $capstone9PlaygroundPresets[3]['url'],
            'launchUrl' => $tensorflowPlaygroundBaseUrl,
            'launchLabel' => 'Open Full Playground',
            'presets' => $capstone9PlaygroundPresets,
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

$navItems = [
    ['label' => 'Home', 'href' => 'index.php'],
    ['label' => 'About', 'href' => 'about.php'],
    ['label' => 'Incremental Capstone', 'href' => 'incremental-capstone.php', 'children' => $capstoneProgramGroups],
    ['label' => 'Projects', 'href' => 'projects.php'],
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
