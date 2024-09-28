export default function formatFieldName(string)
{
    return string.replaceAll(/[A-Z]/g, (m) => ` ${m.toLowerCase()}`).trim();
}