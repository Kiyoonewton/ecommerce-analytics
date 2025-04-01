<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GraphQL Playground - E-commerce Analytics</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/graphql-playground-react/build/static/css/index.css" />
    <link rel="shortcut icon" href="https://cdn.jsdelivr.net/npm/graphql-playground-react/build/favicon.png" />
    <script src="https://cdn.jsdelivr.net/npm/graphql-playground-react/build/static/js/middleware.js"></script>
</head>
<body>
    <div id="root">
        <style>
            body {
                background-color: rgb(23, 42, 58);
                font-family: Open Sans, sans-serif;
                height: 100vh;
                margin: 0;
                overflow: hidden;
            }
            #root {
                height: 100vh;
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .loading {
                font-size: 32px;
                font-weight: 200;
                color: rgba(255, 255, 255, .6);
                margin-left: 20px;
            }
            img {
                width: 78px;
                height: 78px;
            }
            .title {
                font-weight: 400;
            }
        </style>
        <img src='https://cdn.jsdelivr.net/npm/graphql-playground-react/build/logo.png' alt=''>
        <div class="loading">
            <span class="title">GraphQL Playground</span>
        </div>
    </div>
    <script>
        window.addEventListener('load', function (event) {
            const root = document.getElementById('root');
            root.classList.add('playgroundIn');
            
            GraphQLPlayground.init(root, {
                endpoint: '/graphql',
                subscriptionEndpoint: '/graphql/subscriptions',
                settings: {
                    'request.credentials': 'same-origin',
                }
            })
        })
    </script>
</body>
</html><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GraphQL Playground - E-commerce Analytics</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/graphql-playground-react/build/static/css/index.css" />
    <link rel="shortcut icon" href="https://cdn.jsdelivr.net/npm/graphql-playground-react/build/favicon.png" />
    <script src="https://cdn.jsdelivr.net/npm/graphql-playground-react/build/static/js/middleware.js"></script>
</head>
<body>
    <div id="root">
        <style>
            body {
                background-color: rgb(23, 42, 58);
                font-family: Open Sans, sans-serif;
                height: 100vh;
                margin: 0;
                overflow: hidden;
            }
            #root {
                height: 100vh;
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .loading {
                font-size: 32px;
                font-weight: 200;
                color: rgba(255, 255, 255, .6);
                margin-left: 20px;
            }
            img {
                width: 78px;
                height: 78px;
            }
            .title {
                font-weight: 400;
            }
        </style>
        <img src='https://cdn.jsdelivr.net/npm/graphql-playground-react/build/logo.png' alt=''>
        <div class="loading">
            <span class="title">GraphQL Playground</span>
        </div>
    </div>
    <script>
        window.addEventListener('load', function (event) {
            const root = document.getElementById('root');
            root.classList.add('playgroundIn');
            
            GraphQLPlayground.init(root, {
                endpoint: '/graphql',
                subscriptionEndpoint: '/graphql/subscriptions',
                settings: {
                    'request.credentials': 'same-origin',
                }
            })
        })
    </script>
</body>
</html>