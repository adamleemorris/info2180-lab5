document.addEventListener("DOMContentLoaded", function () {
  document.getElementById("lookup").addEventListener("click", function () {
    var country = encodeURIComponent(document.getElementById("country").value);
    var url = "world.php?country=" + country;

    fetch(url)
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json(); // Parse JSON response here
      })
      .then((data) => {
        document.getElementById("result").innerHTML = data;
      })
      .catch((error) => {
        console.error("There was a problem with the fetch operation:", error);
      });
  });

  document.getElementById("lookup_city").addEventListener("click", function () {
    var country = encodeURIComponent(document.getElementById("country").value);
    var url = "world.php?country=" + country + "&lookup=cities";

    fetch(url)
      .then((response) => {
        if (!response.ok) {
          throw new Error("Network response was not ok");
        }
        return response.json(); // Parse JSON response here
      })
      .then((data) => {
        document.getElementById("result").innerHTML = data;
      })
      .catch((error) => {
        console.error("There was a problem with the fetch operation:", error);
      });
  });
});
