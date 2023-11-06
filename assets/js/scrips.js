const options = {
      first: {
        name: "Тема 1",
      },
      second: {
        name: "Тема 2",
      },
      third: {
        name: "Тема 3",
      },
    };

    const $theme = $("select#theme");

    $theme.on("change", () => {
      const value = $theme.val();
      const table = $(".table");

      switch (value) {
        case "first":
          table.empty();
          table.append(options.first);
          break;
        case "second":
          table.empty();
          table.append(options.second);
          break;
        case "third":
          table.empty();
          table.append(options.third);
          break;
        default:
          console.log("Нет такой темы");
          break;
      }
    });