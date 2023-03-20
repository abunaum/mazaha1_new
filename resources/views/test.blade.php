<!DOCTYPE html>
<html>
<head>
    <title>OpenAI Terminal</title>
    <style>
        body {
            font-family: monospace;
            background-color: #2C2F33;
            color: #FFFFFF;
            padding: 20px;
        }

        #terminal {
            width: 100%;
            height: 400px;
            overflow-y: auto;
            border: 1px solid #FFFFFF;
            padding: 10px;
            margin-bottom: 10px;
        }

        #input {
            width: 100%;
            border: none;
            background-color: transparent;
            color: #FFFFFF;
            font-size: 16px;
            margin-bottom: 10px;
        }

        #input:focus {
            outline: none;
        }
    </style>
</head>
<body>
<div id="terminal"></div>
<input id="input" type="text" placeholder="Enter your text here...">
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    const promptSymbol = "> ";
    const terminal = document.getElementById("terminal");
    const input = document.getElementById("input");

    // Add prompt symbol to the terminal
    function addPrompt() {
        const prompt = document.createElement("span");
        prompt.textContent = promptSymbol;
        terminal.appendChild(prompt);
    }

    // Add output to the terminal
    function addOutput(output) {
        const line = document.createElement("div");
        line.innerHTML = output;
        terminal.appendChild(line);
    }

    //axios.get('{{ route('ai') }}', {
    // params: {
    //     input: input
    // }})
    // .then(function (response) {
    //     console.log(response)
    //     // const output = response.data.choices[0].text;
    //     // addOutput(output);
    //     // addPrompt();
    //     // input.value = '';
    // })
    //     .catch(function (error) {
    //         console.log(error);
    //     });
    // Send request to OpenAI API
    function sendRequest(input) {
        axios.get('{{ route('ai') }}', {
            params: {
                prompt: input,
            }
        })
            .then(response => {
                const jawaban = response.data.jawaban;
                        addOutput(jawaban);
                        addPrompt();
                input.value = '';
            })
            .catch(error => {
                console.error(error);
            });
        {{--let data = JSON.stringify({--}}
        {{--    "prompt": input--}}
        {{--});--}}
        {{--axios.get('{{ route('ai') }}', data)--}}
        {{--    .then(function (response) {--}}
        {{--        console.log(response);--}}
        {{--        // addOutput(response.answer);--}}
        {{--        // addPrompt();--}}
        {{--        // input.value = '';--}}
        {{--    })--}}
        {{--    .catch(function (error) {--}}
        {{--        console.log(error);--}}
        {{--    });--}}
    }

    // Handle user input
    function handleInput() {
        const value = input.value.trim();

        if (value.length > 0) {
            addOutput(value);
            sendRequest(value);
        }

        addPrompt();
        input.value = '';
    }

    addPrompt();

    // Listen for Enter key press
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {
            handleInput();
        }
    });
</script>
</body>
</html>
