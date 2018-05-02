<script>
    jQuery(document).ready(function () {
        jQuery('.search-form').submit(function (e) {
            var search = document.getElementById('search');

            jQuery.ajax({
                url: "http://simple.rest/api/users/search/" + search.value,
                method: "GET",
                success: function (data) {
                  if (!data) {
                      jQuery('.no-user').css('display', 'block');

                      jQuery('.user .id .data').html('');
                      jQuery('.user .name .data').html('');
                      jQuery('.user .surname .data').html('');
                      jQuery('.user .email .data').html('');

                  } else {
                      jQuery('.user .id .data').html(data.id);
                      jQuery('.user .name .data').html(data.name);
                      jQuery('.user .surname .data').html(data.surname);
                      jQuery('.user .email .data').html(data.email);

                      jQuery('.no-user').css('display', 'none');
                  }
                },
            });

            e.preventDefault();
        });
    });
</script>

<form class="search-form">
    <label for="search">Enter user's name</label>
    <input type="text" id="search" name="search" />
    <input type="submit" name="search" value="Search" />
</form>

<div class="user">
    <div class="id">
        <b>ID</b>
        <div class="data"></div>
    </div>
    <div class="name">
        <b>Name</b>
        <div class="data"></div>
    </div>
    <div class="surname">
        <b>Surname</b>
        <div class="data"></div>
    </div>
    <div class="email">
        <b>Email</b>
        <div class="data"></div>
    </div>
</div>
<br>
<div class="no-user">No matches.</div>