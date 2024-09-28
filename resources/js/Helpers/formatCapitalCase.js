// (Edit Profile, edit-profile) => EditProfile
export default function formatCapitalCase(string)
{
    let result = [];

    if (!string.includes('-') && !string.includes(' ')) {
        return string.charAt(0).toUpperCase() + string.substring(1);
    }

    if (string.includes('-')) {
        result = string.split('-');
    }

    if (string.includes(' ')) {
        result = string.split(' ');
    }

    result = result.map(str => str.charAt(0).toUpperCase() + str.substring(1)).join('');

    return result;
}