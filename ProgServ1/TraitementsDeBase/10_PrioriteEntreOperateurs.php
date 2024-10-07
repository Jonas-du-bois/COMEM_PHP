<html>
    <head>
        <meta charset="utf-8" />
        <link rel="shortcut icon" href="#" /> <!-- pour éviter le message favicon.ico dans la fenêtre output -->
        <title>Priorités entre opérateurs</title>
        <style>
            table, th, td {
                border: 1px solid black;
            }
            table tr:nth-child(odd){
                background-color:#F0F0F0;
            }
        </style>
    </head>
    <body>
      <br>
      Tableau des priorités entre opérateurs :
      <br><br>
      <table>
            <thead>
                <tr>
                    <th>&emsp; Priorité&emsp; </th>
                    <th>Opérateurs</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>&emsp; 1</td>
                    <td>&emsp; () &emsp; []</td>
                </tr>
                <tr>
                    <td>&emsp; 2</td>
                    <td>&emsp; ** &emsp; -- &emsp; ++ !</td>
                </tr>
                <tr>
                    <td>&emsp; 3</td>
                    <td>&emsp; * &emsp; / &emsp; %</td>
                </tr>
                <tr>
                    <td>&emsp; 4</td>
                    <td>&emsp; + &emsp; -</td>
                </tr>
                <tr>
                    <td>&emsp; 5</td>
                    <td>&emsp; < &emsp; <= &emsp; >= &emsp; ></td>
                </tr>
                <tr>
                    <td>&emsp; 6</td>
                    <td>&emsp; == &emsp; != &emsp; === &emsp; <=></td>
                </tr>
                <tr>
                    <td>&emsp; 7</td>
                    <td>&emsp; &</td>
                </tr>
                <tr>
                    <td>&emsp; 8</td>
                    <td>&emsp; |</td>
                </tr>
                <tr>
                    <td>&emsp; 9</td>
                    <td>&emsp; &&</td>
                </tr>
                <tr>
                    <td>&emsp; 10</td>
                    <td>&emsp; ||</td>
                </tr>
                <tr>
                    <td>&emsp; 11</td>
                    <td>&emsp; ?? &emsp; ?:</td>
                </tr>
                <tr>
                    <td>&emsp; 12</td>
                    <td>&emsp; = &emsp; += &emsp; -= &emsp; *= &emsp; /= &emsp; **= &emsp; %= &emsp;</td>
                </tr>
                <tr>
                    <td>&emsp; 13</td>
                    <td>&emsp; AND &emsp; OR</td>
                </tr>
                <tr>
                    <td>&emsp; 14</td>
                    <td>&emsp; XOR</td>
                </tr>
            </tbody>
        </table>
    </body>
</html>