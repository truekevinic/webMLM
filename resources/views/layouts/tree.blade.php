<div>
    <script src="https://d3js.org/d3.v5.min.js"></script>
    <script>
        var svg = d3.select("body").append("svg")
            .attr("width", 600).attr("height", 600)
            .append("g").attr("transform", "translate(50,50)");

        var data = [{ "child": "John", "parent": "" },
                { "child": "Aaron", "parent": "Kevin" },
                { "child": "Kevin", "parent": "John" },{ "child": "asd", "parent": "John" },
                { "child": "Hannah", "parent": "Ann" },
                { "child": "Rose", "parent": "Sarah" },
                { "child": "Ann", "parent": "John" },
                { "child": "Sarah", "parent": "Kevin" },
                { "child": "Mark", "parent": "Ann" },
                { "child": "Angel", "parent": "Sarah" }];
        var dataStructure = d3.stratify().id(function (d) { return d.child; }).parentId(function (d) { return d.parent; })
        (data);
        var treeStructure = d3.tree().size([500, 300]);
        var information = treeStructure(dataStructure);
        var circles = svg.append("g").selectAll("circle").data(information.descendants());
        circles.enter().append("circle").attr("cx", function (d) { return d.x; }).attr("cy", function (d) { return d.y; }).attr("r", 5);

        var connections = svg.append("g").selectAll("path").data(information.links());
        connections.enter().append("path").attr("d", function(d){return "M" + d.source.x+ "," + d.source.y + " C " +d.source.x+ "," +(d.source.y + d.target.y)/2 +" " +d.target.x+ "," +(d.source.y + d.target.y)/2 +" "+d.target.x+ "," + d.target.y;
        });
        var names = svg.append("g").selectAll("text").data(information.descendants());
        names.enter().append("text").text(function(d){return d.data.child;}).attr("x",function(d){return d.x+5;}).attr("y", function(d){return d.y+2;})
    </script>
</div>
