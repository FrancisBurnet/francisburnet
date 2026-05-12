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
        'summary' => 'Circle dataset with a compact network for reading the learned boundary.',
        'url' => $tensorflowPlaygroundBaseUrl . '#activation=tanh&batchSize=10&dataset=circle&regDataset=reg-plane&learningRate=0.03&regularizationRate=0&noise=0&networkShape=4,2&seed=0.11599&showTestData=false&discretize=false&percTrainData=50&x=true&y=true&xTimesY=false&xSquared=false&ySquared=false&cosX=false&sinX=false&cosY=false&sinY=false&collectStats=false&problem=classification&initZero=false&hideText=true',
    ],
    [
        'label' => 'Hidden Layers On Spiral Data',
        'summary' => 'Spiral classification with deeper hidden layers to show when extra capacity helps.',
        'url' => $tensorflowPlaygroundBaseUrl . '#activation=tanh&batchSize=10&dataset=spiral&regDataset=reg-plane&learningRate=0.03&regularizationRate=0&noise=0&networkShape=8,6,4&seed=0.11599&showTestData=false&discretize=false&percTrainData=50&x=true&y=true&xTimesY=false&xSquared=false&ySquared=false&cosX=false&sinX=false&cosY=false&sinY=false&collectStats=false&problem=classification&initZero=false&hideText=true',
    ],
    [
        'label' => 'ReLU On XOR',
        'summary' => 'XOR classification preset for comparing a different activation and topology.',
        'url' => $tensorflowPlaygroundBaseUrl . '#activation=relu&batchSize=10&dataset=xor&regDataset=reg-plane&learningRate=0.03&regularizationRate=0&noise=0&networkShape=6,3&seed=0.11599&showTestData=false&discretize=false&percTrainData=50&x=true&y=true&xTimesY=false&xSquared=false&ySquared=false&cosX=false&sinX=false&cosY=false&sinY=false&collectStats=false&problem=classification&initZero=false&hideText=true',
    ],
    [
        'label' => 'Regularization Under Noise',
        'summary' => 'Gaussian data with noise and regularization for overfitting discussion.',
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
            'summary' => 'TensorFlow Playground presets make the deep learning concepts on this page interactive without changing the capstone evidence flow.',
            'note' => 'This lab is an optional concept sandbox. The notebook, requirement checklist, and saved artifacts remain the graded evidence.',
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
    ],
    [
        'key' => 'capstone-session-11',
        'label' => 'Capstone 11',
        'href' => 'capstone-session-11.php',
        'sourceFolder' => 'Capstone Session 11',
        'heroTitle' => 'Capstone Session 11 Infographic',
        'heroCaption' => 'Objective, data profile, and grading-aligned outputs for Capstone Session 11.',
        'summary' => 'Session 11 deep learning capstone page for grammar and product review analysis.',
    ],
    [
        'key' => 'capstone-session-12',
        'label' => 'Capstone 12',
        'href' => 'capstone-session-12.php',
        'sourceFolder' => 'Capstone Session 12',
        'heroTitle' => 'Capstone Session 12 Infographic',
        'heroCaption' => 'Objective, data profile, and grading-aligned outputs for Capstone Session 12.',
        'summary' => 'Session 12 deep learning capstone page for panoramic dental autoencoder artifacts.',
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

$capstone1VerificationNotebookRepoPath = 'Incremental%20Capstones/Applied%20Data%20Science%20with%20Python/Capstone%201/capstone_1_colab_verification.ipynb';
$capstone1VerificationNotebookSourceUrl = 'https://github.com/FrancisBurnet/francisburnet/blob/main/' . $capstone1VerificationNotebookRepoPath;
$capstone1VerificationNotebookLaunchUrl = 'https://colab.research.google.com/github/FrancisBurnet/francisburnet/blob/main/' . $capstone1VerificationNotebookRepoPath;
$capstone2NotebookRepoPath = 'Incremental%20Capstones/Applied%20Data%20Science%20with%20Python/Capstone%202/capstone_2.ipynb';
$capstone2NotebookSourceUrl = 'https://github.com/FrancisBurnet/francisburnet/blob/main/' . $capstone2NotebookRepoPath;
$capstone2NotebookLaunchUrl = 'https://colab.research.google.com/github/FrancisBurnet/francisburnet/blob/main/' . $capstone2NotebookRepoPath;
$capstone3NotebookRepoPath = 'Incremental%20Capstones/Applied%20Data%20Science%20with%20Python/Capstone%203/capstone_3.ipynb';
$capstone3NotebookSourceUrl = 'https://github.com/FrancisBurnet/francisburnet/blob/main/' . $capstone3NotebookRepoPath;
$capstone3NotebookLaunchUrl = 'https://colab.research.google.com/github/FrancisBurnet/francisburnet/blob/main/' . $capstone3NotebookRepoPath;
$capstone4NotebookRepoPath = 'Incremental%20Capstones/Applied%20Data%20Science%20with%20Python/Capstone%204/capstone_4.ipynb';
$capstone4NotebookSourceUrl = 'https://github.com/FrancisBurnet/francisburnet/blob/main/' . $capstone4NotebookRepoPath;
$capstone4NotebookLaunchUrl = 'https://colab.research.google.com/github/FrancisBurnet/francisburnet/blob/main/' . $capstone4NotebookRepoPath;

$colabVerificationConfig = [
    'capstone-1' => [
        'launchUrl' => getenv('COLAB_CAPSTONE_1_LAUNCH_URL') ?: $capstone1VerificationNotebookLaunchUrl,
        'publicNotebookSourceUrl' => getenv('COLAB_CAPSTONE_1_NOTEBOOK_SOURCE_URL') ?: $capstone1VerificationNotebookSourceUrl,
        'publicDatasetMirrorUrl' => getenv('COLAB_CAPSTONE_1_DATASET_MIRROR_URL') ?: null,
    ],
    'capstone-2' => [
        'launchUrl' => getenv('COLAB_CAPSTONE_2_LAUNCH_URL') ?: $capstone2NotebookLaunchUrl,
        'publicNotebookSourceUrl' => getenv('COLAB_CAPSTONE_2_NOTEBOOK_SOURCE_URL') ?: $capstone2NotebookSourceUrl,
        'publicDatasetMirrorUrl' => getenv('COLAB_CAPSTONE_2_DATASET_MIRROR_URL') ?: null,
    ],
    'capstone-3' => [
        'launchUrl' => getenv('COLAB_CAPSTONE_3_LAUNCH_URL') ?: $capstone3NotebookLaunchUrl,
        'publicNotebookSourceUrl' => getenv('COLAB_CAPSTONE_3_NOTEBOOK_SOURCE_URL') ?: $capstone3NotebookSourceUrl,
        'publicDatasetMirrorUrl' => getenv('COLAB_CAPSTONE_3_DATASET_MIRROR_URL') ?: null,
    ],
    'capstone-4' => [
        'launchUrl' => getenv('COLAB_CAPSTONE_4_LAUNCH_URL') ?: $capstone4NotebookLaunchUrl,
        'publicNotebookSourceUrl' => getenv('COLAB_CAPSTONE_4_NOTEBOOK_SOURCE_URL') ?: $capstone4NotebookSourceUrl,
        'publicDatasetMirrorUrl' => getenv('COLAB_CAPSTONE_4_DATASET_MIRROR_URL') ?: null,
    ],
];
