import * as d3 from "d3";
$(function () {
    var svg = d3.select("#graph")
        .attr("width", "100px")
        .attr("height", "100px");
    svg.selectAll("rect.bar");
});
