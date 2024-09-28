// (Edit Profile, EditProfile, edit profile) => edit-profile
export default function formatKebabCase(string)
{
    if (string.includes(' ')) {
        return string.replaceAll(' ', '-').toLowerCase();
    } else {
        return string.replaceAll(/[A-Z]/g, (m) => ` ${m.toLowerCase()}`).trim().replaceAll(' ', '-');
    }
}