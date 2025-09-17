# Requires: pandoc installed and available on PATH
# Uses assets/Report/Report.docx as reference style

param(
  [string]$InputMarkdown = "f:\XAMMP\htdocs\fitness_win11\assets\report\report.md",
  [string]$OutputDocx = "f:\XAMMP\htdocs\fitness_win11\assets\report\FitnessClub-Report.docx",
  [string]$ReferenceDocx = "f:\XAMMP\htdocs\fitness_win11\assets\Report\Report.docx"
)

if (!(Get-Command pandoc -ErrorAction SilentlyContinue)) {
  Write-Error "pandoc not found. Install from https://pandoc.org/install.html and rerun."; exit 1
}

# Ensure SVGs resolve relative to markdown file
Push-Location (Split-Path $InputMarkdown)

# Build DOCX with reference style
pandoc "$(Split-Path -Leaf $InputMarkdown)" `
  --from gfm `
  --to docx `
  --resource-path . `
  --reference-doc "$ReferenceDocx" `
  --output "$OutputDocx"

Pop-Location
Write-Host "Report generated: $OutputDocx"
