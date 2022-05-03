<div class="row">
    <div class="col">
        <table class="table">
            <tr>
                <td class="text-center">1</td>
                <td>2</td>
                <td class="text-end">3</td>
            </tr>
            <tr>
                <td>4</td>
                <td>5</td>
                <td>6</td>
            </tr>
            <tr>
                <td>7</td>
                <td>8</td>
                <td>9</td>
            </tr>
            <tr>
                <td>10</td>
                <td>11</td>
                <td>12</td>
            </tr>
            <tr>
                <td>13</td>
                <td>14</td>
                <td>15</td>
            </tr>
        </table>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("td").click(function(){
            $("td").addClass("text-center");
            $("td").removeClass("bg-primary text-white");
            $(this).toggleClass("bg-primary text-white");
        });
    });
</script>