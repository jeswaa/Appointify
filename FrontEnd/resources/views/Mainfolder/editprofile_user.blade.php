<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="{{ asset('assets/css/editprofile_user.css') }}">
</head>
<body>
    <div class="profile-page">
        <div class="header">
            <a href="#" class="back-button">← BACK</a>
        </div>
        <div class="profile-wrapper">
            <div class="profile-section">
                <img src="profile-placeholder.png" alt="Profile Picture" class="profile-image">
                <p class="change-profile">CHANGE PROFILE</p>
            </div>
            <div class="form-section">
                <form>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" value="William S. Smither">
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" id="address" value="3452 Pine St. California New York">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" id="phone" value="09248634971">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" value="william3456@gmail.com">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <input type="text" id="gender" value="Male">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" placeholder="Username">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" placeholder="Password">
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="submit-btn">SUBMIT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
