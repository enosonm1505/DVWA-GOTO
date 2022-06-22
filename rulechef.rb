# Disallow insecure protocols by testing

describe package('telnetd') do
  it { should_not be_installed }
end

